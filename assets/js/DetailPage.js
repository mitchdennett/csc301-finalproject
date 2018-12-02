import { DetailListView } from './DetailListView.js';

export class DetailPage {
    constructor(){
        
    }

    appendToElement(el) {
        if(!this.element){
            this.createElement();
            this.setupHandlers();
        }
        el.append(this.element);
    }

    setupHandlers() {
        
    }

    setImgSrc(src) {
        this.element.find('#panel-img').attr('src', src);
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    addDetailListView(details) {
        this.listView = new DetailListView();
        this.listView.sidebar = this.sidebar;

        this.listView.appendToElement(this.element.find('.cd-panel__main_content'));
        this.listView.addDetails(details);
    }

    getElementString() {
        return `<div class="cd-panel__content">
                    <div style="text-align: center;">
                        <img id="panel-img" src="">
                    </div>
                    <div class="cd-panel__main_content">

                    </div>
                </div>`;
    }
}