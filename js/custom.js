function updateBasketIcon() {

    const basketWrapper = document.getElementById("basket-wrapper") ?? '';

    if (basketWrapper) {
    let basket = document.cookie.match('(^|;)\\s*' + "basket" + '\\s*=([^;]+)')?.pop();
    if (basket) {
        basket = basket.split("%");
        if (basket[0] === "") {
            basket.shift();
        }
        if (basket[basket.length-1] === "5D") {
            basket.pop();
        }
  
    basketWrapper.setAttribute('data-after', basket.length);
    } else {
        basketWrapper.setAttribute('data-after', 0);
    }
}
};