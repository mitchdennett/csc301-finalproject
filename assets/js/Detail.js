import { AddToCartPage } from "./AddToCartPage.js";

export class Detail {

    constructor(detail){
        this.detail = detail;
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
        var addToCartPage = new AddToCartPage(this.detail);
        this.sidebar.addPage(addToCartPage);
        addToCartPage.setImgSrc(this.sidebar.src);

    }

    createElement(){
        let s = this.getElementString();
        this.element = $(s);
    }

    getElementString() {
        return `<tr class="detail-row">
                    <td class="td-name">
                        <a href="#notebook">
                            ${ this.detail.description }
                        </a>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td class="td-number">
                        $${this.detail.price}
                    </td>
                </tr>`;
    }
}