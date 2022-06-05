const BG_TYPE = "bgType";

export default class BgFieldset {
    _BgTypes = {};
    _bgType;

    _radioImg;
    _radioRgb;
    _inputImg;
    _inputRgb;

    constructor(IMG, RGB) {
        this._BgTypes.img = IMG;
        this._BgTypes.rgb = RGB;

        this._bgType = this._BgTypes.img;

        this._radioImg = document.querySelector(
            `input[value='${this._BgTypes.img}']`
        );
        this._radioRgb = document.querySelector(
            `input[value='${this._BgTypes.rgb}']`
        );
        this._inputImg = document.querySelector(
            `input[name="${this._BgTypes.img}"]`
        );
        this._inputRgb = document.querySelector(
            `input[name="${this._BgTypes.rgb}"]`
        );

        this.toggleBgType = this.toggleBgType.bind(this);

        this._radioImg.addEventListener("change", this.toggleBgType);
        this._radioRgb.addEventListener("change", this.toggleBgType);

        const storageBgType = localStorage.getItem(BG_TYPE);
        if (storageBgType === this._BgTypes.rgb) {
            this._radioRgb.checked = true;
            this.setRgb();
        } else {
            this._radioImg.checked = true;
            this.setImg();
        }

        window.addEventListener("beforeunload", () => {
            localStorage.setItem(BG_TYPE, this._bgType);
        });
    }

    toggleBgType(e) {
        switch (e.target) {
            case this._radioImg:
                this.setImg();
                break;
            case this._radioRgb:
                this.setRgb();
                break;
        }
    }

    setImg() {
        this._bgType = this._BgTypes.img;
        this._inputImg.disabled = false;
        this._inputRgb.disabled = true;
    }

    setRgb() {
        this._bgType = this._BgTypes.rgb;
        this._inputImg.disabled = true;
        this._inputRgb.disabled = false;
    }

    get uriEncoded() {
        return `bgType=${this._bgType}&${this._inputImg.name}=${this._inputImg.value}&${this._inputRgb.name}=${this._inputRgb.value}`;
    }
}
