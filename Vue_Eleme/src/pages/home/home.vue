<template>
    <div id="home">

        <div class="entirety" id="entirety">
            <div class="header-weather-address">
                <div class="header-address"><span class="position1"><i class="fa fa-map-marker"></i></span><p v-if="address"><p v-if="address">{{address.name}}</p><span class="position2"><i class="fa fa-caret-down"></i></span></div>
                <div class="header-weather" v-if="weather">
                    <div >
                        <h2>{{weather.temperature}}°</h2>
                        <p>{{weather.description}}</p>
                    </div>
                    <img v-bind:src="getImg(weather.image_hash,'69x69')" alt="">
                </div>

            </div>
            <div class="search-box">
                <a class="search-box-content">
                    <i class="fa fa-search"></i>
                    <span>搜索商家,商品名称</span>
                </a>
            </div>
            <div class="keywords" v-if="hotwodrs">
                <div class="keywords-list">
                    <a href="#" v-for="item in hotwodrs">{{item.word}}</a>

                </div>
            </div>
            <div class="classify-box">
                <div class="classify-main" @touchstart="start" @touchmove="move" @touchend="end" v-if="entries" >
                    <div class="classify-main-one" v-show="oneDisplay" v-bind:class="divOne">
                        <a href="#" v-for="(item,index) in entries" v-if="index < 8" >
                            <div>
                                <img :src="getImg(item.image_hash,'99x99')">
                            </div>
                            <span class="classify-title">{{item.name}}</span>
                        </a>

                    </div>
                    <div class="classify-main-two" v-show="twoDisplay" v-bind:class="showTwo">
                        <a href="#"  v-for="(item,index) in entries" v-if="8 <= index" >
                            <div>
                                <img :src="getImg(item.image_hash,'99x99')">
                            </div>
                            <span class="classify-title">{{item.name}}</span>
                        </a>
                    </div>
                </div>
                <div class="classify-btn">
                   <i class="fa fa-circle"></i>
                   <i class="fa fa-circle-o"></i>
                </div>
            </div>
            <div class="shop-list-all">
                <h3>推荐商家</h3>

                <child v-bind:value="positions"></child>

            </div>
            <div class="toTop" id="toTop" v-on:click="toTopGo">
                <span>Top</span>
            </div>
            <div style="text-align: center">加载<i class="fa fa-spinner fa-spin"></i></div>
            <div class="footer"></div>

        </div>



        <m-footer></m-footer>
    </div>
</template>
<script type="text/ecmascript-6">


    import child from '@/components/child'
    import {
        getPosition,
        getAddress,
        getWeather,
        getHotword,
        getClassify,

        myMixin
    } from '@/data/getData';
    import {
        setStorage,
        getStorage,

    } from '@/config/location';
    import mFooter from '@/components/footer';
    export default
    {

        name:'home',
        components:{
            child,
            mFooter
        },
        mixins:[myMixin],
        created()
        {

        },
        data()
        {
            return{
                positions:null,
                address:null,
                weather:null,
                hotwodrs:null,
                classify:null,
                shoplist:null,



                entries:null,
                oneDisplay:true,
                twoDisplay:false,
                startX:'',
                changedX:'',
                endX:'',
                showTwo:'',
                divOne:'',

            }
        },
        watch:{
            positions:function () {
                this.initData();
            }
        },



        methods:{

            toTopGo:function () {
                document.body.scrollTop = 0
            },
            start(event)
            {
                this.twoDisplay = true;
                this.oneDisplay = true;
                this.startX = event.changedTouches[0].screenX;
            },

            move(event)
            {

            },
            end(event)
            {
//                console.log('end');
//                console.log(event);
                this.endX = event.changedTouches[0].screenX;
                if (event.target.classList.contains("classify-main-one") || event.target.offsetParent.classList.contains("classify-main-one"))
                {
                    if ((this.startX - this.endX) > 200)
                    {
                        this.showTwo = 'toTranslate';
                        this.divOne = 'toTranslateright'
                        this.oneDisplay = false;

                    }
                    else
                    {
                        this.divOne = 'toTranslate';
                        this.showTwo = 'toTranslateright';
                        this.twoDisplay = false;


                    }
                }
                if (event.target.classList.contains("classify-main-two") || event.target.offsetParent.classList.contains("classify-main-two"))
                {

//                    if ((this.endX - this.startX) > 200)
//                    {
//                        this.twoDisplay = false;
//                        this.showTwo = 'toTranslateright';
//                        this.divOne = 'toTranslate'
//                    }
//                    else
//                    {
//                        this.oneDisplay = false;
//                        this.showTwo = 'toTranslate';
//                        this.divOne = 'toTranslateright';
//                    }
                    if ((this.startX - this.endX) > 200)
                    {
                        this.showTwo = 'toTranslateright';
                        this.divOne = 'toTranslate'
                        this.twoDisplay = false;
                    }
                    else
                    {
                        this.divOne = 'toTranslateright';
                        this.showTwo = 'toTranslate';
                        this.oneDisplay = false;
                    }
                }
            },
            initData:function () {
                getAddress(this.positions.latitude,this.positions.longitude).then(response => {
                    this.address = response;
                }).catch(error => {
                    console.log(error);
                });
                getWeather(this.positions.latitude,this.positions.longitude).then(response => {
                    this.weather = response;
                }).catch(error => {
                    console.log(error);
                });
                getHotword(this.positions.latitude,this.positions.longitude).then(response => {
                    this.hotwodrs = response;
                }).catch(error => {
                    console.log(error);
                });
                getClassify(this.positions.latitude,this.positions.longitude).then(response => {
                    this.classify = response;
                    this.entries = this.classify[0].entries;
                }).catch(error => {
                    console.log(error);
                });
            }
        },
        async mounted()
        {
            try
            {
                let posiiton = await getPosition();
                this.positions = {
                    latitude:posiiton.coords.latitude,
                    longitude:posiiton.coords.longitude,
                };
                console.log(this.positions);
                this.$store.commit('changePositions',this.positions);
                console.log(this.$store.state.positions);
                setStorage(location,this.positions);
            }
            catch (error)
            {
                console.log(error);
                this.positions = getStorage('location');
                setStorage(location,this.positions);
            }
        },

    }
</script>
<style lang="scss" type="text/scss">
    @import "../../scss/mixin.scss";
    .entirety
    {
        width: 100%;
        background-color: whitesmoke;
    }

    .search-box-show
    {
        display: block !important;
    }




    .footer
    {
        width: 100%;
        height: pxToRem(100px);
    }
    .header-weather-address
    {
        background-color: deepskyblue;
        @include flex();
        padding:{
            top:pxToRem(20px);
            left: pxToRem(28px);
            right:pxToRem(28px);
            bottom: pxToRem(0);
        };
        box-sizing: border-box;
        .header-address
        {
            padding: pxToRem(10px);
            position: relative;
            color: white;
            font-weight: bold;
            .position1
            {
                font-size: pxToRem(35px);
                font-weight: 900;
            }
            .position2
            {
                font-weight: bold;
                font-size: pxToRem(24px);
                line-height: pxToRem(29px);
                margin-left: pxToRem(30px);
                position: absolute;
                top:0;
            }
            p
            {
                display: inline-block;
                font-size: pxToRem(34px);
                margin-left: pxToRem(15px);
            }
        }
        .header-weather
        {
            color: white;
            @include flex();
            img
            {
                width: pxToRem(55px);
                height: pxToRem(55px);
                margin-left: pxToRem(10px);
            }
            h2
            {
                font-size: pxToRem(28px);
            }
            p
            {
                font-size: pxToRem(20px);
                text-align: right;
            }
        }
    }
    .search-box
    {
        z-index: 999;
        position: sticky;
        top:pxToRem(-1px);
        background-color: deepskyblue;
        width: 100%;
        padding: {
            bottom:pxToRem(15px);
            left:pxToRem(28px);
            right:pxToRem(28px);
            top:pxToRem(15px);
        };
        .search-box-content
        {
            background-color: white;
            width: 100%;
            height:pxToRem(72px);
            @include flex(center,center);
            text-align: center;
            font-weight: bold;
            color: rgb(102,102,102);
            span
            {
                margin-left: pxToRem(10px);
                font-size: pxToRem(26px);
            }
        }
    }
    .keywords
    {
        background-color: deepskyblue;

        padding: {
            bottom:pxToRem(30px);
            left:pxToRem(28px);
            right:pxToRem(28px);
            top:pxToRem(15px);
        };
        .keywords-list
        {
            width: 100%;
            color: white;
            box-sizing: border-box;
            font-size: pxToRem(24px);
            white-space: nowrap;
            overflow-x: auto;
            a
            {
                margin-right: pxToRem(30px);
                cursor: auto;
                font-size: pxToRem(24px);
            }
        }
    }

    .classify-box
    {
        width: 100%;
        .classify-main{
            position: relative;
            height: pxToRem(354px);
        }
        overflow-x: auto;
        padding-bottom: pxToRem(10px);
        box-sizing: border-box;
        width: 100%;
        background-color: white;
        .classify-btn
        {
            text-align: center;
            font-size: pxToRem(10px);
            i
            {
                color: grey;
                margin-right: pxToRem(5px);
                margin-left: pxToRem(5px);
            }
        }
        .classify-main-two
        {
            position: absolute;
            left: 100%;
            box-sizing: border-box;
            height: pxToRem(354px);
            color: rgb(51,51,51);
            font-size: pxToRem(24px);
            width: 100%;
            @include flex('','');
            flex-wrap: wrap;
            transition: left 0.5s;


        }
        .classify-main-one
        {
            position: absolute;
            left:0;
            box-sizing: border-box;
            height: pxToRem(354px);
            color: rgb(51,51,51);
            font-size: pxToRem(24px);
            width: 100%;
            @include flex('','');
            flex-wrap: wrap;
            transition: left 0.5s;

        }
        img
        {
            width: pxToRem(90px);
            height:pxToRem(90px);
        }
        a
        {
            text-align: center;
            box-sizing: border-box;
            cursor: auto;
            width: 25%;
            margin: 0;
            padding-top: pxToRem(22px);
            .classify-title
            {
                margin-top: pxToRem(10px);
                color: rgb(102,102,102);
            }
        }
    }
    .classify-box .toTranslate
    {
        left: 0;
    }

    .classify-box .toTranslateHide
    {
        left: -100%;

    }
    .classify-box .toTranslateright
    {
        left: 100%;
    }
    .shop-list-all{
        margin-top: pxToRem(20px);
        background-color: white;
        padding-top: pxToRem(20px);


        h3{
            margin-left: pxToRem(20px);
            margin-top: pxToRem(20px);
            font-size: pxToRem(32px);
        }
    }
    .toTop
    {
        height: pxToRem(100px);
        width: pxToRem(100px);
        line-height: pxToRem(100px);
        text-align: center;
        background-color: deepskyblue;
        position: fixed;
        right: pxToRem(30px);
        bottom: pxToRem(200px);
        border: 1px solid deepskyblue;
        z-index: 200;

    }

</style>