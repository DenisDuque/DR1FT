class Membership {
    constructor() {
        const self = this;
        this.yearly = true;
        document.addEventListener('DOMContentLoaded', function() {
            self.premiumMonthly = document.getElementById('monthly-premium-price').value;
            self.vipMonthly = document.getElementById('monthly-vip-price').value;
            if(self.premiumMonthly && self.vipMonthly) {
                self.membershipLengthElements = document.querySelectorAll('.membership-length');
                self.vipPriceElement = document.getElementById('monthly-vip-price-show');
                self.premiumPriceElement = document.getElementById('monthly-premium-price-show');

                if (self.vipPriceElement && self.premiumPriceElement) {
                    let containerDiv = document.getElementById('container');

                    let observer = new MutationObserver(function(mutationsList, observer) {
                        mutationsList.forEach(mutation => {
                            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                                const currentClass = containerDiv.className;
                                if (currentClass !== self.previousClass) {
                                    self.changeLength();
                                    self.previousClass = currentClass;
                                }
                            }
                        });
                    });
                    observer.observe(containerDiv, { attributes: true });
                }
            }
        });
    }

    changeLength() {
        this.yearly = !this.yearly;
        if (this.yearly == true) {
            this.setYearly();
        } else {
            this.setMonthly();
        }
    }

    setMonthly() {
        this.vipPriceElement.innerHTML = this.vipMonthly + '$';
        this.premiumPriceElement.innerHTML = this.premiumMonthly + '$';

        this.membershipLengthElements.forEach(element => {
            element.innerHTML = '/monthly';
        });
    }

    setYearly() {

        this.vipPriceElement.innerHTML = this.calculateYearPrice(this.vipMonthly) + '$';
        this.premiumPriceElement.innerHTML = this.calculateYearPrice(this.premiumMonthly) + '$';

        this.membershipLengthElements.forEach(element => {
            element.innerHTML = '/yearly';
        });
    }

    calculateYearPrice($monthlyPrice) {
        // Dejamos un margen de ahorro para el usuario, para incitar a la compra de packs más largos
        return parseInt($monthlyPrice) * 10;
    }
}

const MembershipObject = new Membership();