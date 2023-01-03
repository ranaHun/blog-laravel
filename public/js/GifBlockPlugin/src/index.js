import './index.css';

import Ui from './ui';

import { IconPicture } from '@codexteam/icons';

export default class GifTool {



  static get toolbox() {
    return {
      title: 'gif',
      icon: IconPicture
    };
  }


  /**
     * @param {object} tool - tool properties got from editor.js
     * @param {ImageToolData} tool.data - previously saved data
     * @param {ImageConfig} tool.config - user config for Tool
     * @param {object} tool.api - Editor.js API
     * @param {boolean} tool.readOnly - read-only mode flag
     */
  constructor({ data, config, api, readOnly }) {
    this.api = api;
    this.readOnly = readOnly;

    /**
     * Tool's initial config
     */
    this.config = {
      endpoints: config.endpoints || '',
      buttonContent: config.buttonContent || '',
      actions: config.actions || [],
    };

    /**
     * Module for working with UI
     */
    this.ui = new Ui({
      api,
      config: this.config,
      onSelectFile: () => {
        // this.uploader.uploadSelectedFile({
        //   onPreview: (src) => {
        //     this.ui.showPreloader(src);
        //   },
        // });
        this.ui.nodes.selectorModalContainer.style.display = "block";

      },
      readOnly,
    });

    /**
     * Set saved state
     */
    this._data = {};
    this.data = data;
  }


  render() {
    return this.ui.render(this.data);
  }

  save(blockContent) {
    return {
      url: blockContent.value
    }
  }

  /**
 * Fires after clicks on the Toolbox Image Icon
 * Initiates click on the Select File button
 *
 * @public
 */
  appendCallback() {
    this.ui.nodes.fileButton.click();
  }
}