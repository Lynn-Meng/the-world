<template>

    <div id="shop">
        <div class="entirety" v-if="shopmessage">
            <div class="header">
                <!--头部的蒙版-->
                <div class="shopHeader" v-bind:style="{backgroundImage:getImgurl(shopmessage.image_path)}">
                    <div class="meng"></div>
                </div>
                <!--头部的返回按钮-->
                <div class="shopHeader-back">
                    <button @click="$router.go(-1)"><i class="fa fa-angle-left"></i></button>
                </div>
                <!--头部的主要信息-->
                <div class="header-main">
                    <img :src="getImg(shopmessage.image_path,'130x130')">
                    <div class="header-main-content">
                        <h2>{{shopmessage.name}}</h2>
                        <p class="header-main-delivery">
                            <span v-if="shopmessage.delivery_mode">蜂鸟配送</span><span v-else>商家配送</span> / </span>
                            <span v-if="shopmessage.order_lead_time">{{shopmessage.order_lead_time}}分钟送达 /</span>
                            <span v-if="shopmessage.piecewise_agent_fee">{{shopmessage.piecewise_agent_fee.tips}}</span>
                        </p>
                        <div class="header-main-notice">公告:{{shopmessage.promotion_info}}</div>
                    </div>
                </div>
                <!--头部活动信息-->
                <div class="activity" v-on:click="toggleGongGao">
                    <activity :activity="shopmessage.activities"></activity>
                    <div class="num-of-activity">{{shopmessage.activities.length}}个活动></div>
                </div>

            </div>
            <transition name="fade">

                <div class="particulars" v-show="isShowGongGao">
                    <h2>{{shopmessage.name}}</h2>
                    <span class="star">
                    <stars :star="shopmessage.rating"></stars>
                </span>
                    <h3 class="youhuimsg">
                        <span>优惠信息</span>
                    </h3>
                    <div class="activity-hidden">
                        <activity :activity="shopmessage.activities"></activity>
                    </div>
                    <h3 class="youhuimsg">
                        <span>商家公告</span>
                    </h3>
                    <div class="iiiiiii">公告:{{shopmessage.promotion_info}}</div>

                    <div class="clsoe"><span class="fa fa-times" v-on:click="hiddenGongGao"></span></div>

                </div>
            </transition>

            <div class="shop-tab-container">
                <div class="shop-tab-tab " v-on:click="checkSelect($event),isCommodity=true,isEvaluate=false,isStore=false">
                    <span class="shop-tab-title selected " >商品</span>
                </div>
                <div class="shop-tab-tab" v-on:click="checkSelect($event),isEvaluate=true,isCommodity=false,isStore=false">
                    <span class="shop-tab-title">评价</span>
                </div>
                <div class="shop-tab-tab" v-on:click="checkSelect($event),isStore=true,isCommodity=false,isEvaluate=false">
                    <span class="shop-tab-title">店铺</span>
                </div>
            </div>
            <div v-show="isCommodity">
                <div class="commodity-main">
                    <ul class="commodity-main-left">
                        <li v-for="item in Commoditylist" ><img v-if="item.icon_url"    :src="getImg(item.icon_url,'18x20')"><span>{{item.name}}</span></li>
                    </ul>
                    <section class="commodity-main-right">
                        很多很多汉堡
                    </section>
                </div>
                <div class="commodity-footer">

                </div>

            </div>
            <div v-show="isEvaluate">评价</div>
            <div v-show="isStore">店铺</div>


        </div>

        <!--<button @click="$router.go(-1)">Back</button>-->
    </div>

</template>
<script type="text/ecmascript-6">
    import activity from '@/components/activitys2';
    import stars from '@/components/star';
    import {
        getShopmessage,
        getCommoditylist,
        myMixin,

    } from '@/data/getData';
    export default
    {
        name: 'shop',
        mixins: [myMixin],
        components: {
            activity,
            stars
        },
        data()
        {
            return {
                id: '',
                latitude: '',
                longitude: '',
                shopmessage: null,
                Commoditylist: null,
                isShowGongGao: false,

                isCommodity:true,
                isEvaluate:false,
                isStore:false

            }
        },
        methods: {



            //切换   商品评价店铺  类
            checkSelect: function (ev) {
                if(ev.target.classList.value == 'shop-tab-title selected')
                {
                    return false;
                }else
                {
                    if (ev.target.classList.value == 'shop-tab-title') {
                        document.getElementsByClassName('selected')[0].classList.remove('selected');
                        ev.target.classList.add('selected');
                    }
                    else {
                        document.getElementsByClassName('selected')[0].classList.remove('selected');
                        ev.target.childNodes[0].classList.add('selected');
                    }
                }

            },
            //给活动区添加点击事件  让详情显示出来
            toggleGongGao: function () {
                this.isShowGongGao = true;
            },
            hiddenGongGao: function () {
                this.isShowGongGao = false;
            },


            getImgurl: function (hash) {
                let one = hash.substring(0, 1);
                let two = hash.substring(1, 3);
                let type = hash.substring(32);
                let main = hash.substring(3);
                const url = 'url' + '("' + 'https://fuss10.elemecdn.com/' + one + '/' + two + '/' + main + '.' + type + '?imageMogr/format/webp/thumbnail/!40p/blur/50x40/' + '")';
                console.log(url);
                return url;
            }
        },
        created()
        {




            //获取由列表发过来的数据
            this.id = this.$route.query.id;
            this.latitude = this.$route.query.latitude;
            this.longitude = this.$route.query.longitude;
            getShopmessage(this.id, this.latitude, this.longitude).then(response => {
                this.shopmessage = response;
//                console.log(this.shopmessage);
            }).catch(error => {
                console.log(error);
            });


            getCommoditylist(this.id).then(response => {
                this.Commoditylist = response;
                console.log('common');
//                console.log(this.Commoditylist);
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>

<style lang="scss" type="text/scss">

    @import "../../scss/mixin.scss";

    body, html {
        height: 100%;
    }

    .header {
        height: pxToRem(283px);
        position: relative;
    }

    .shopHeader {
        box-sizing: content-box;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        -webkit-text-size-adjust: 100%;
        height: pxToRem(283px);
        z-index: 0;
        color: rgb(255, 255, 255);
        /*background-color: rgb(49, 144, 232);*/
        /*opacity: 0.9;*/

        .meng
        {
            background-color: rgb(49, 144, 232);
            opacity: 0.2;
            width: 100%;
            height: 100%;
        }

    }

    .shopHeader-back {
        position: relative;
        z-index: 1;
        height: pxToRem(71px);
        padding: pxToRem(8px) pxToRem(20px);
        i {

            display: inline-block;
            font-size: pxToRem(60px);
            width: pxToRem(50px);
            height: pxToRem(50px);
            font-weight: bold;
            color: white;
        }
    }

    .header-main {
        position: relative;
        z-index: 1;
        box-sizing: content-box;
        padding: pxToRem(20px) pxToRem(30px) pxToRem(0px) pxToRem(30px);
        @include flex();
        img {
            border-radius: pxToRem(4px);
            border: 1px solid white;
            height: pxToRem(130px);
            width: pxToRem(130px);
            margin-right: pxToRem(20px);
        }
        .header-main-content {
            font-weight: bold;
            font-size: pxToRem(22px);
            color: white;
            width: 100%;
            text-align: left;
            h2 {
                height: pxToRem(50px);
                font-size: pxToRem(35px);
                overflow-x: hidden;
                overflow-y: hidden;
                text-overflow: ellipsis;
            }
            .header-main-delivery {
                height: pxToRem(50px);
                width: 100%;
                white-space: nowrap;
                line-height: pxToRem(50px);
            }
            .header-main-notice {
                line-height: pxToRem(40px);
                overflow-y: hidden;
                height: pxToRem(40px);

            }
        }
    }

    .activity {
        display: flex;
        justify-content: space-between;
        font-size: pxToRem(22px);
        color: white;
        height: pxToRem(36px);
        line-height: pxToRem(36px);
        position: absolute;
        z-index: 1;
        bottom: pxToRem(10px);
        overflow-y: hidden;
        margin-left: pxToRem(30px);
        margin-right: pxToRem(30px);
        width: pxToRem(690px);
        .num-of-activity {

            position: absolute;
            right: 0;
            bottom: 0;
        }
    }

    .particulars {
        border-style: solid;
        border-color: rgb(38, 38, 38);
        border-left-width: pxToRem(60px);
        border-right-width: pxToRem(60px);
        border-top-width: pxToRem(80px);

        box-sizing: border-box;
        text-align: center;
        color: white;
        position: absolute;
        z-index: 222;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(38, 38, 38);
        .clsoe {
            width: 100%;
            position: absolute;
            color: rgb(222, 222, 222);
            text-align: center;
            bottom: pxToRem(50px);
            font-size: pxToRem(100px);
        }
        .star {
            margin-top: pxToRem(10px);
            font-size: pxToRem(50px);
            display: inline-block;
        }
        .youhuimsg {
            margin-top: pxToRem(60px);
            margin-bottom: pxToRem(40px);
            span {
                font-size: pxToRem(24px);
                padding: pxToRem(10px) pxToRem(28.8px);
                border: 1px solid rgb(85, 85, 85);
                border-bottom-left-radius: pxToRem(50px);
                border-bottom-right-radius: pxToRem(50px);
                border-top-left-radius: pxToRem(50px);
                border-top-right-radius: pxToRem(50px);
            }
        }
        .activity-hidden {
            text-align: left;
            div {
                line-height: pxToRem(40px);
            }
        }
        .iiiiiii {
            text-align: left;
        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active in below version 2.1.8 */
    {
        opacity: 0
    }

    .shop-tab-container {
        box-sizing: content-box;
        line-height: pxToRem(80px);
        background-color: white;
        border: 1px solid rgb(238, 238, 238);
        @include flex();
        .shop-tab-tab {
            box-sizing: content-box;
            font-size: pxToRem(28px);
            line-height: pxToRem(80px);
            text-align: center;
            width: 100%;
            span {
                box-sizing: border-box;
                display: inline-block;
                height: pxToRem(80px);
            }
            .selected {
                border-bottom: 6px solid rgb(49, 144, 232);
                color: rgb(49, 144, 232);
                font-weight: bold;
            }

        }
    }
    .commodity-main{
        @include flex();
        line-height: pxToRem(29px);

        .commodity-main-left{
            background-color: rgb(248,248,248);
            display: block;
            font-size: pxToRem(24px);
            list-style-position: outside;
            list-style-type: none;
            overflow-y: auto;
            width: pxToRem(170px);
            img
            {
                margin-right: pxToRem(10px);
                text-align: left;
                width: pxToRem(18px);
                height: pxToRem(25px);
            }
            li
            {
                display: list-item;
                border-bottom: 1px solid rgb(237,237,237);
                color: rgb(102,102,102);
                font-size: pxToRem(26px);
                line-height: pxToRem(31.2px);
                padding: pxToRem(35px) pxToRem(15px);
                position: relative;
                text-align: left;

            }
        }
    }



</style>