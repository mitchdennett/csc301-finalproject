import { DetailPage } from "./DetailPage.js";

export class Product {

    constructor(product){
        this.product = product;
    }

    appendToElement(el) {
        this.createElement();
        this.setupHandlers();
        el.append(this.element);
    }

    setupHandlers() {
        this.element.click((event) => {
            this.onClick(event);
        });
        
    }
    onClick(event) {
        var detailPage = new DetailPage();
        this.sidebar.addPage(detailPage);
        detailPage.setImgSrc(this.sidebar.src);
        detailPage.addDetailListView(this.product.details);
    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    getElementString() {
        return `<tr class="product-row">
                    <td class="td-name">
                        <a href="#notebook">
                            ${ this.product.name }
                        </a>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td class="td-number">
                        <small>From</small>$9.00
                    </td>
                </tr>`;
    }
}