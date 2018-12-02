import { ProductListView } from './ProductListView.js';

export class ProductsPage {
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

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    addProductListView(categories) {
        this.listView = new ProductListView();
        this.listView.sidebar = this.sidebar;

        this.listView.appendToElement(this.element.find('.cd-panel__main_content'));
        this.listView.addCategories(categories);
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