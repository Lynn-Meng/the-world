<template>
    <div id="child">
        <div v-for="item in shoplist" class="shop-list">
            <div style="display: flex">
                <router-link :to="{path:'/shop', query:{id:item.id,latitude:item.latitude,longitude:item.longitude}}">
                    <div class="shop-list-left">
                        <img :src="getImg(item.image_path,'130x130')">
                    </div>
                </router-link>

                <div class="shop-list-right">
                    <router-link to="/shop" :to="{path:'/shop', query:{id:item.id,latitude:item.latitude,longitude:item.longitude}}">

                        <section class="shop-list-line1">
                            <span class="shop-name">{{item.name}}</span>
                            <span class="shop-supports" v-if="item.supports">保</span>
                        </section>
                        <section class="shop-list-line2">
                            <div style="display: flex;">
                                <stars :star="item.rating"></stars>
                                <span class="shop-rating">{{item.rating}}</span>
                                <span class="shop-order-num">月售{{item.recent_order_num}}单</span>
                            </div>
                            <div>
                                <span class="delivery_mode" v-if="item.delivery_mode">蜂鸟配送</span>
                            </div>
                        </section>
                        <section class="shop-list-line3">
                            <div v-if="item.piecewise_agent_fee">
                                <span>¥{{item.piecewise_agent_fee.rules[0].price}}起送</span>
                                <span>|</span>
                                <span class="tips">{{item.piecewise_agent_fee.tips}}</span>
                            </div>
                            <div>
                                <span class="delivery_mode">{{getKm(item.distance)}}</span>
                                <span>|</span>
                                <span class="time">{{item.order_lead_time}}分钟</span>

                            </div>
                        </section>
                        <hr>
                    </router-link>

                    <section class="shop-list-line4" v-if="item.activities">
                        <activities :activity="item.activities"></activities>
                    </section>
                </div>

            </div>

            <hr>
        </div>
    </div>
</template>
<script type="text/ecmascript-6">
    import {
        getShoplist,
        myMixin,
    } from '@/data/getData';
    import stars from '@/components/star';
    import activities from '@/components/activity';
    export default{
        name: 'child',
        props: {

            value: {
                default: null,
            }

        },
        mounted()
        {
            window.addEventListener('scroll', this.scrollWindow);
        },

        components: {
            stars,
            activities
        },
        data()
        {
            return {
                isShow: false,
                isHidden: true,
                shoplist: null,
                offset: 1,
                isLoad: true,
            }
        },
        mixins: [myMixin],
        watch: {
            value: function () {
                getShoplist(this.value.latitude, this.value.longitude, 0).then(response => {
                    this.shoplist = response;
                }).catch(error => {
                    console.log(error);
                })
            }
        },

//        computed:{
//            "item.distance":function () {
//               return this.item.distance > 1000 ? this.item.distance / 1000 + 'km' : this.item.distance + 'm';
//            },
//        },
        methods: {


            getKm: function (m) {
                if (m > 1000) {
                    m = m / 1000;
                    return m + 'km';
                }
                else {
                    return m + 'm';
                }
            },

            scrollWindow: function () {

                let maxHeight = document.body.clientHeight;
                let windowHeight = window.innerHeight;
                if (window.scrollY == maxHeight - windowHeight) {
                    console.log(this.isLoad);

                    if (this.isLoad == false) {
                        return false;
                    }
                    this.isLoad = false;
                    this.offset += 20;
                    console.log('到底了 别拉了');
                    getShoplist(this.value.latitude, this.value.longitude, this.offset).then(response => {
                        console.log(this.shoplist);
                        this.shoplist = this.shoplist.concat(response);
//                        for (var i = 0; i < response.length; i++)
//                        {
//                            this.shoplist.push(response[i]);
//                        }
                        this.isLoad = true;

                    }).catch(error => {
                        console.log(error);
                    })
                }

            },

        },


    }
</script>
<style type="text/scss" lang="scss">
    @import "../scss/mixin.scss";

    .shop-list {
        a {
            text-decoration: none;
        }
        hr {
            margin-top: pxToRem(20px);
            opacity: 0.3;
        }
        .shop-list-left {
            position: relative;
            flex-basis: auto;
            padding: pxToRem(30px) pxToRem(20px);
            img {
                width: pxToRem(130px);
                height: pxToRem(130px);
                position: relative;
                top: 0;
            }
        }
        .shop-list-right {
            position: relative;
            padding-right: pxToRem(20px);
            padding-top: pxToRem(30px);
            width: 100%;
            .shop-list-line1 {
                @include flex();
                .shop-supports {
                    line-height: pxToRem(26.4px);
                    font-size: pxToRem(22px);
                    list-style-type: none;
                    box-sizing: border-box;
                    list-style-position: outside;
                    display: flex;
                    color: rgb(102, 102, 102);
                    -webkit-text-size-adjust: 100%;
                }
                .shop-name {
                    font-size: pxToRem(30px);
                    line-height: pxToRem(36px);
                    text-overflow: ellipsis;
                    font-weight: bold;
                }
            }
            .shop-list-line2 {
                @include flex();
                font-size: pxToRem(22px);
                margin-top: pxToRem(15px);
                line-height: pxToRem(26.4px);
                color: rgb(102, 102, 102);
                .delivery_mode {
                    color: white;
                    background-color: rgb(68, 165, 255);
                    border: 1px solid rgb(68, 165, 255);
                    border-radius: pxToRem(4px);
                }
            }
            .shop-list-line3 {
                @include flex();
                margin-top: pxToRem(18px);
                font-size: pxToRem(22px);
                color: rgb(102, 102, 102);
                line-height: pxToRem(24px);
            }
            hr {
                margin-top: pxToRem(15px);
                margin-bottom: pxToRem(10px);
                opacity: 0.5;
            }
            .shop-list-line4 {
                position: relative;
                .num-of-huodong {
                    color: rgb(153, 153, 154);
                    height: pxToRem(77px);
                    line-height: pxToRem(20px);
                    font-size: pxToRem(20px);
                    padding-bottom: pxToRem(15px);
                    position: absolute;
                    right: 0;
                    top: pxToRem(20px);
                }

                .shop-list-show {
                    margin-top: pxToRem(5px);
                }
                line-height: pxToRem(36px);
                color: rgb(102, 102, 102);
                font-size: pxToRem(26px);
                .font-shou {
                    font-size: pxToRem(22px);
                    color: white;
                    border: 1px solid rgb(112, 188, 70);
                }
                .font-news {
                    font-size: pxToRem(22px);
                }
                .shop-list-hidden {
                    display: none;
                    margin-top: pxToRem(5px);
                }
                .display {

                    display: block;
                }

            }

        }
    }

</style>