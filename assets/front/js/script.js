
        function openBox_ier123kr(data) {
            if (data.closeBox) {
                document.querySelectorAll(`.${data.closeBox}`).forEach(box => {
                    box.classList.add('d-none');
                });
            }
            if (data.openBox) {
                document.querySelectorAll(`.${data.openBox}`).forEach(box => {
                    box.classList.remove('d-none');
                });
            }
        }
        function ConvertNumberToPersion() {
            let persian = { 0: '۰', 1: '۱', 2: '۲', 3: '۳', 4: '۴', 5: '۵', 6: '۶', 7: '۷', 8: '۸', 9: '۹' };
            function traverse(el) {
                if (el.nodeType == 3) {
                    var list = el.data.match(/[0-9]/g);
                    if (list != null && list.length != 0) {
                        for (var i = 0; i < list.length; i++)
                            el.data = el.data.replace(list[i], persian[list[i]]);
                    }
                }
                for (var i = 0; i < el.childNodes.length; i++) {
                    traverse(el.childNodes[i]);
                }
            }
            traverse(document.body);
        }
        ConvertNumberToPersion();
        function watchScroll(data) {
            if (data.top) {
                let btnGoTo823238   = document.querySelector(`#${data.btnId}`)
                window.addEventListener('scroll', e => {
                    if (btnGoTo823238) {
                        if (window.scrollY > data.top) {
                            btnGoTo823238.classList.remove('d-none')
                        } else {
                            btnGoTo823238.classList.add('d-none')
                        }
                    }
                })
            }
        }
        watchScroll({btnId: 'goToTop', top: 200});
        var swiper = new Swiper(".mySwiperC454", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
                "@1.75": {
                    slidesPerView: 5,
                    spaceBetween: 60,
                },
            },
        });
        var swiper = new Swiper(".mySwiperC455", {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
        var swiper = new Swiper(".mySwiperC461", {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
                "@1.75": {
                    slidesPerView: 5,
                    spaceBetween: 60,
                },
            },
        });