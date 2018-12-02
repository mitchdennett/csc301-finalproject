import { CategoryTabView } from './CategoryTabView.js';

export class ProductListView {
    constructor(){
        
    }

    appendToElement(el) {
        this.createElement();
        this.setupHandlers();
        el.append(this.element);
    }

    setupHandlers() {
        
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    addCategories(categories) {
        this.categories = [];

        var isFirst = true;
        for(let x in categories){
            let category = categories[x];
            let categoryView = new CategoryTabView(category, isFirst);
            categoryView.sidebar = this.sidebar;
            this.addCategoryLine(category,isFirst);
            if(isFirst){
                isFirst = false;
            }
            categoryView.appendToElement(this.element.find('#my-tab-content'))
            categoryView.addProducts();
        }
    }

    addCategoryLine(category, isFirst) {
        let elementString = `<li class="nav-item">
                                <a class="nav-link${ isFirst ? ' active' : ''}" data-toggle="tab" href="#cat_${category.categoryid}" role="tab"
                                    aria-expanded="${ isFirst ? 'true' : 'false'}">
                                    ${category.description}
                            </li>`;

        let element = $(elementString);
        element.appendTo(this.element.find('#tabs'));
    }

    getElementString() {
        return `<div class="panel-items">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul id="tabs" class="nav nav-tabs" role="tablist">
                                
                            </ul>
                        </div>
                    </div>
                    <div id="my-tab-content" class="tab-content text-center">
                    
                    </div>
                </div>`;
    }
}