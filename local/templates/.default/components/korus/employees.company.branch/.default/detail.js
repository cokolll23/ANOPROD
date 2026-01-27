BX.ready(function () {
    class LeaderSliderUI {
        constructor (events, options) {
            this.events = events;
            this.options = options;
        }

        get slideCount () {
            return Math.ceil(this.events.length / this.options.perSlide);
        }

        update (options) {
            this.options = BX.merge({}, this.options, options);
        }

        render (root) {
            const slides = [];
            root.innerHTML = '';

            let slideIndex = -1;
            while (++slideIndex < this.slideCount) {
                slides[slideIndex] = this._renderSlide(slideIndex);
            }

            root.append(...slides);
        }

        _renderSlide (slideIndex) {
            const indexStart = slideIndex * this.options.perSlide;
            const indexEnd = indexStart + this.options.perSlide;
            const events = this.events.slice(indexStart, indexEnd);

            return BX.create('li', {
                props: { className: 'glide__slide branch-detail-event-slider-item' },
                attrs: { 'data-glide-slide': '' },
                children: [
                    BX.create('div', {
                        props: { className: 'branch-detail-event-list' },
                        children: events.map(event => this._renderEvent(event))
                    })
                ]
            });
        }

        _renderEvent (event) {
            return BX.create('div', {
                props: { className: 'branch-detail-event' },
                children: [
                    this._renderDate(event),
                    this._renderContent(event)
                ]
            });
        }

        _renderDate (event) {
            const { day, month } = event;

            return BX.create('div', {
                props: { className: 'branch-detail-event-date-wrapper' },
                children: [
                    BX.create('span', { props: { classList: 'branch-detail-event-date-day' }, text: day }),
                    BX.create('span', { props: { classList: 'branch-detail-event-date-month' }, text: month })
                ]
            });
        }

        _renderTime (timeFrom, timeTo) {
            return BX.create('div', {
                props: { className: 'branch-detail-event-time kt-mask-icon-wrapper' },
                children: [
                    BX.create('span', {
                        props: { classList: 'branch-detail-event-time-icon kt-ui-size-md kt-mask-icon' },
                    }),
                    BX.create('span', {
                        props: { className: 'branch-detail-event-time-value' },
                        text: timeFrom + (timeTo ? ` - ${timeTo}` : '')
                    })
                ]
            });
        }

        _renderContent (event) {
            const { link, name, timeFrom, timeTo, place } = event;
            const children = [
                this._renderTitle(link, name),
            ];

            if(timeFrom.length > 0 || timeTo.length > 0) {
                children.push(this._renderTime(timeFrom, timeTo))
            }

            if (place != null && place.length > 0) {
                children.push(this._renderLocation(place));
            }

            return BX.create('div', {
                props: { className: 'branch-detail-event-content' },
                children
            });
        }

        _renderTitle (href, text) {
            console.log(href);
            if(href != null && href.length > 0) {
                return BX.create('a', {
                    props: {className: 'branch-detail-event-title ui-link ui-link-dark', href},
                    attrs: {
                        target: '_blank',
                        title: text,
                    },
                    text
                });
            } else {
                return BX.create('span', {
                    props: {className: 'branch-detail-event-title'},
                    attrs: {
                        title: text,
                    },
                    text
                });
            }
        }

        _renderLocation (location) {
            return BX.create('div', {
                props: { className: 'branch-detail-event-location kt-mask-icon-wrapper' },
                children: [
                    BX.create('span', {
                        props: { classList: 'branch-detail-event-location-icon kt-ui-size-md kt-mask-icon' },
                    }),
                    BX.create('span', {
                        props: { className: 'branch-detail-event-location-value' },
                        attrs: {
                            title: location,
                        },
                        text: location
                    })
                ]
            });
        }
    }

    const selectors = {
        sliderLeader: '#js-branch-detail-direction-leader-slider',
        sliderEvents: '#js-branch-detail-event-slider'
    };
    const leaderSliderParams = {
        glideOptions: {
            perView: 3,
            gap: 15,
            breakpoints: {
                576: {
                    perView: 1
                },
                1280: {
                    perView: 2
                },
                1600: {
                    perView: 3
                }
            }
        }
    };
    const eventsSliderParams = {
        autoplay: false,
        glideOptions: {
            perView: 1
        },
        data: eventsData || [],
        itemsPerSlideMap: {
            0: 1,
            768: 2,
            1280: 4
        },
        UIProvider: LeaderSliderUI
    };

    if (document.querySelector(selectors.sliderLeader)) {
        new BX.KTControllers.GlideSliderController(selectors.sliderLeader, leaderSliderParams).mount();
    }

    if (document.querySelector(selectors.sliderEvents)) {
        new BX.KTControllers.GlideSliderController(selectors.sliderEvents, eventsSliderParams).mount();
    }
});
