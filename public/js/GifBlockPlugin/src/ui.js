import { IconPicture } from '@codexteam/icons';

import { make } from './utils/dom';
import {httpGetAsync } from './utils/httpService';

/**
 * Class for working with UI:
 *  - rendering base structure
 *  - show/hide preview
 *  - apply tune view
 */
export default class Ui {

    /**
  * @param {object} ui - image tool Ui module
  * @param {object} ui.api - Editor.js API
  * @param {ImageConfig} ui.config - user config
  * @param {Function} ui.onSelectFile - callback for clicks on Select file button
  * @param {boolean} ui.readOnly - read-only mode flag
  */
    constructor({ api, config, onSelectFile, readOnly }) {
        this.api = api;
        this.config = config;
        this.onSelectFile = onSelectFile;
        this.readOnly = readOnly;
        this.nodes = {
            wrapper: make('div', [this.CSS.baseClass, this.CSS.wrapper]),
            imageContainer: make('div', [this.CSS.imageContainer]),
            fileButton: this.createFileButton(),
            imageEl: undefined,
            imagePreloader: make('div', this.CSS.imagePreloader),
            caption: make('div', [this.CSS.input, this.CSS.caption], {
                contentEditable: !this.readOnly,
            }),
            selectorModalContainer: make('div', this.CSS.selectorModalContainer),
            selectorModalContent: make('div', this.CSS.selectorModalContent)
        };

        /**
         * Create base structure
         *  <wrapper>
         *    <image-container>
         *      <image-preloader />
         *    </image-container>
         *    <caption />
         *    <select-file-button />
         *  </wrapper>
         */

        this.nodes.selectorModalContent.appendChild(this.createFileSelector());
        this.nodes.selectorModalContainer.appendChild(this.nodes.selectorModalContent);

        this.nodes.caption.dataset.placeholder = this.config.captionPlaceholder;
        this.nodes.imageContainer.appendChild(this.nodes.imagePreloader);
        this.nodes.wrapper.appendChild(this.nodes.imageContainer);
        this.nodes.wrapper.appendChild(this.nodes.caption);
        this.nodes.wrapper.appendChild(this.nodes.fileButton);
        this.nodes.wrapper.appendChild(this.nodes.selectorModalContainer);
    }


    /**
 * CSS classes
 *
 * @returns {object}
 */
    get CSS() {
        return {
            baseClass: this.api.styles.block,
            loading: this.api.styles.loader,
            input: this.api.styles.input,
            button: this.api.styles.button,

            /**
             * Tool's classes
             */
            wrapper: 'image-tool',
            imageContainer: 'image-tool__image',
            imagePreloader: 'image-tool__image-preloader',
            imageEl: 'image-tool__image-picture',
            caption: 'image-tool__caption',
            selectorModalContainer: 'image-tool__modal',
            selectorModalContent: 'image-tool__modal-content'
        };
    };

    /**
     * Creates select-gif button
     *
     * @returns {Element}
     */
    createFileButton() {
        const button = make('div', [this.CSS.button]);

        button.innerHTML = this.config.buttonContent || `${IconPicture} ${this.api.i18n.t('Select an Image')}`;

        button.addEventListener('click', () => {
            this.getGifsData();
            this.onSelectFile();
        });

        return button;
    }

    createFileSelector() {
        const container = make('div');

        const span = make('span', 'image-tool__close');
        span.innerHTML = '&times;'
        span.onclick = () => {
            this.nodes.selectorModalContainer.style.display = 'none';
        }
        container.appendChild(span);


        const content = make('div');
        content.style.display = 'flex';
        content.style['flex-direction'] = 'column';
        content.style['align-items'] = 'center';
        container.appendChild(content);

        const searchBar = make('div', 'searchBar')
        const searchInput = make('input', '', { type: "text", placeholder: "Search a Gif" })
        searchBar.appendChild(searchInput);

        const searchButton = make('button')
        searchButton.innerHTML = "Search"
        searchButton.addEventListener('click', () => {
            const searchKey = searchInput.value
            this.getGifsData(searchKey)
        });

        searchBar.appendChild(searchButton);
        content.appendChild(searchBar);

        const gifList = make('div', 'gifList', { id: 'gif-list' })
        const cssStyleForImageSelection = `
        li {
            display: inline-block;
          }
input[type="checkbox"][id^="myCheckbox"] {
    display: none;
  }
  
  .image-lable {
    border: 1px solid #fff;
    // padding: 10px;
    display: block;
    position: relative;
    // margin: 10px;
    cursor: pointer;
  }
  
  .image-lable:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
  }
  
  .image-lable img {
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
  }
  
  :checked + .image-lable {
    border-color: #ddd;
  }
  
  :checked + .image-lable:before {
    content: "✓";
    background-color: grey;
    transform: scale(1);
  }
  
  :checked + .image-lable img {
    transform: scale(0.9);
    /* box-shadow: 0 0 5px #333; */
    z-index: -1;
  }
        `;
        const gifListStyle = make('style');
        gifListStyle.innerHTML = cssStyleForImageSelection;
        content.appendChild(gifListStyle);
        gifList.style.display = 'flex';
        gifList.style['flex-wrap'] = 'wrap';
        gifList.style.padding = '4px';
        content.appendChild(gifList)

        const gifListLoader = make('div', 'gifListLoader');
        gifListLoader.style.display = 'none';
        gifListLoader.style.width = '60px';
        gifListLoader.style.height = '60px';
        gifListLoader.style.background = ' #fffbfb00 url("https://media.giphy.com/media/8agqybiK5LW8qrG3vJ/giphy.gif") center no-repeat'
        content.appendChild(gifListLoader);

        const insertButton = make('button')
        insertButton.innerHTML = "Insert"
        insertButton.addEventListener('click', () => {
            var checkedList = this.nodes.selectorModalContent.querySelectorAll("input[type=checkbox]:checked");
            for (const input of checkedList) {
                const url = input.value;
                console.log(url);
            }
            if (checkedList && checkedList.length > 0) {
                this.fillImage(checkedList[0].value);
                this.nodes.selectorModalContainer.style.display = 'none';
            }
        });

        content.appendChild(insertButton);
        return container;
    }
    creatGifListItem(src, i) {
        const listItem = make('li');
        const input = make('input', null, { type: 'checkbox', id: `myCheckbox${i}`, value: src })
        const label = make('label','image-lable')
        label.htmlFor = `myCheckbox${i}`;

        const img = make('img')
        img.src = src
        img.style.width = '300px'
        img.style.height = '300px'
        img.style.margin = '10px'
        img.style['border-radius'] = '10px'
        img.style['border-color'] = 'black'
        img.style['border-width'] = 'medium'

        label.appendChild(img);

        listItem.appendChild(input);
        listItem.appendChild(label);
        return listItem;
    }
    fillGifList(data) {
        const gifListElement = this.nodes.selectorModalContent.getElementsByClassName('gifList')[0];
        for (let index = 0; index < data.length; index++) {
            const item = data[index];
            if (item.type !== 'gif') {
                continue
            }

            gifListElement.appendChild(this.creatGifListItem(item.images.original.url, index));
        }
    }
    getGifsData(searchKey = undefined) {
        const gifListLoader = this.nodes.selectorModalContent.getElementsByClassName('gifListLoader')[0];
        const gifListElement = this.nodes.selectorModalContent.getElementsByClassName('gifList')[0]
        gifListLoader.style.display = 'block';
        gifListElement.innerHTML = '';
        // Pagination
        const url = searchKey ?
            `https://api.giphy.com/v1/gifs/search?api_key=DH4OAUoxUkZeGE7kOEq00I71CVNOshst&q=${searchKey}&limit=2&offset=0&rating=g&lang=en` :
            `https://api.giphy.com/v1/gifs/trending?api_key=DH4OAUoxUkZeGE7kOEq00I71CVNOshst&limit=10&rating=g`;
        
            httpGetAsync(url).then(value => {
            this.fillGifList(value.data);
            gifListLoader.style.display = 'none';
        })
    }
    /**
      * Ui statuses:
      * - empty
      * - uploading
      * - filled
      *
      * @returns {{EMPTY: string, UPLOADING: string, FILLED: string}}
      */
    static get status() {
        return {
            EMPTY: 'empty',
            UPLOADING: 'loading',
            FILLED: 'filled',
        };
    }

    /**
      * Shows an image
      *
      * @param {string} url - image source
      * @returns {void}
      */
    fillImage(url) {
        const attributes = {
            src: url,
        };



        /**
         * Compose tag with defined attributes
         *
         * @type {Element}
         */
        this.nodes.imageEl = make('img', this.CSS.imageEl, attributes);

        /**
         * Add load event listener
         */
        this.nodes.imageEl.addEventListener('load', () => {
            this.toggleStatus(Ui.status.FILLED);

            /**
             * Preloader does not exists on first rendering with presaved data
             */
            if (this.nodes.imagePreloader) {
                this.nodes.imagePreloader.style.backgroundImage = '';
            }
        });

        this.nodes.imageContainer.appendChild(this.nodes.imageEl);
    }

    /**
     * Renders tool UI
     *
     * @param {ImageToolData} toolData - saved tool data
     * @returns {Element}
     */
    render(toolData) {
        if (!toolData.file || Object.keys(toolData.file).length === 0) {
            this.toggleStatus(Ui.status.EMPTY);
        } else {
            this.toggleStatus(Ui.status.UPLOADING);
        }

        return this.nodes.wrapper;
    }


    /**
 * Changes UI status
 *
 * @param {string} status - see {@link Ui.status} constants
 * @returns {void}
 */
    toggleStatus(status) {
        for (const statusType in Ui.status) {
            if (Object.prototype.hasOwnProperty.call(Ui.status, statusType)) {
                this.nodes.wrapper.classList.toggle(`${this.CSS.wrapper}--${Ui.status[statusType]}`, status === Ui.status[statusType]);
            }
        }
    }


}