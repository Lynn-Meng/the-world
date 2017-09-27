<template>
    <div id="shop">
        <div class="entirety" v-if="shopmessage" ref="entirety">
            <div class="header" ref="sdf">
                <!--头部的蒙版-->
                <div class="shopHeader" v-bind:style="{backgroundImage:getBackgroundImgUrl(shopmessage.image_path)}">
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
                    <ul class="commodity-main-left" ref="commodityMainLeft">
                        <li class="liList" v-for="(item,key) in commoditylist" v-on:click="getIndex(key)"  :class="(key == 0 ? 'activeted' : '')" ref="commodityMainLeftLis" ><img v-if="item.icon_url"     :src="getImg(item.icon_url,'18x20')" ><span v-show="item.name">{{item.name}}</span></li>
                    </ul>
                    <section class="commodity-main-right">
                        <div ref="commodityScroll" class="commodity-scroll" id="commodity-scroll"  v-on:scroll="scrollListen">
                            <dl v-for="item in commoditylist" ref="dls">
                                <dt>
                                    <div class="dt-left">
                                        <strong>{{item.name}}</strong>
                                        <!--<span>{{item.description}}</span>-->
                                    </div>
                                    <div class="dt-right">
                                        <span v-on:click="showBlackBox">...</span>
                                        <p>{{item.name}}{{item.description}}</p>
                                    </div>
                                </dt>


                                <dd v-for="items in item.foods">
                                    <div class="list-food-box">
                                        <div class="list-food-content">
                                            <img :src="getImg(items.image_path,'140x140')"  v-if="items.image_path">
                                            <section class="list-food-content-right">
                                                <strong class="list-food-header-price">
                                                    <span>¥{{items.specfoods[0].price}}<span v-if="items.specfoods[0].specs.length >= 1">起</span></span>
                                                </strong>
                                                <div class="list-food-header-add">
                                                    <a>
                                                       <span class="add-yuan" v-if="items.specfoods[0].specs.length < 1">
                                                            +
                                                       </span>
                                                        <span class="add-yuan-select" v-if="items.specfoods[0].specs.length >= 1" :data-guige="items.virtual_food_id" v-on:click="selectBig(items)">
                                                            选规格
                                                        </span>
                                                    </a>
                                                </div>
                                                <section class="list-food-header">
                                                    <span  v-for="attributes in items.attributes" :style="{backgroundColor:'#' + attributes.icon_color}">
                                                        {{attributes.icon_name}}
                                                    </span>
                                                </section>
                                                <header>
                                                    {{items.name}}
                                                </header>
                                                <p class="list-food-header-description">{{items.description}}</p>
                                                <p class="list-food-header-sales">
                                                    <span>
                                                        月售
                                                        {{items.month_sales}}
                                                        份
                                                    </span>
                                                    <span>
                                                        好评率
                                                        {{items.satisfy_rate}}
                                                        %
                                                    </span>
                                                </p>
                                            </section>

                                        </div>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <transition name="select" >
                            <div class="guige" v-if="guigemessage" >
                                <h1>{{guigemessage.name}}</h1>
                                <div class="guiges">
                                    <div class="guiges-content">
                                        <h2>{{guigemessage.specifications[0].name}}</h2>
                                        <a v-for="item in guigemessage.specifications[0].values">{{item}}</a>
                                    </div>
                                </div>
                                <div class="guiges-price">
                                    <p>¥{{guigemessage.specfoods[0].price}}</p>
                                    <div class="xuanhaole">
                                        <button>选好了</button>
                                    </div>
                                    <a href="javascript:" role="button" class="close" v-on:click="closeguige">X</a>
                                </div>
                            </div>
                        </transition>

                    </section>
                </div>
                <div class="commodity-footer">

                </div>

            </div>
            <div v-show="isEvaluate">评价</div>
            <div v-show="isStore">店铺</div>


        </div>
        <div  ref="mengban" class="mengban" ></div>
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

                commoditylist: null,

                isShowGongGao: false,

                isCommodity:true,
                isEvaluate:false,
                isStore:false,
                guigemessage:false,
                liIndex:-1,

                dlHeightArrs:[],

            }
        },

        watch:{
              liIndex:function () {
                  let lis =  this.$refs.commodityMainLeft.children;
                  for (let i = 0; i < lis.length; i++)
                  {
                      lis[i].classList.remove('activeted');
                  }
                  this.$refs.commodityMainLeftLis[this.liIndex].classList.add('activeted');
              }
        },
        methods: {


            getIndex:function (key) {

                if(key !== 0)
                {
                    this.$refs.commodityScroll.scrollTop = this.dlHeightArrs[key - 1];
                }
                else
                {
                    this.$refs.commodityScroll.scrollTop = 0;
                }



            },


            scrollListen:function () {

                this.$refs.entirety.scrollTop = this.$refs.commodityScroll.scrollTop;

                let dlArr = this.$refs.dls;
                let dlHeightArr = [];
                let sum = 0;
                for (let i = 0; i < dlArr.length; i++)
                {
                    sum = sum + dlArr[i].clientHeight;
                    dlHeightArr.push(sum);
                }
                this.dlHeightArrs = dlHeightArr;


//                console.log('dl',this.dlHeightArrs);


                for (let j = 0; j < this.dlHeightArrs.length;j++)
                    {
                        if(this.$refs.commodityScroll.scrollTop < this.dlHeightArrs[j])
                        {
                            this.liIndex = j;
                            break;
                        }
                    }
                if(this.$refs.commodityScroll.scrollTop > this.dlHeightArrs[7])
                {
                    let ScrollJuli = (this.liIndex - 7) * 130 ;
                    this.$refs.commodityMainLeft.scrollTop = ScrollJuli;
                }
                else
                {
                    this.$refs.commodityMainLeft.scrollTop = 0;
                }
            },

            selectBig:function (guige) {
                this.guigemessage = guige;
                if(this.guigemessage)
                {
                    this.$refs.mengban.classList.add('display');
                }
            },

            closeguige:function()
            {
                this.guigemessage = false;
                if (!this.guigemessage) {


                    this.$refs.mengban.classList.remove('display');
                }

            },
            showBlackBox:function (ev) {
                ev.target.nextElementSibling.classList.toggle('showPbox');
            },


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


//            getImgurl: function (hash) {
//                let one = hash.sub(0, 1);
//                let two = hash.sub(1, 3);
//                let type = hash.sub(32);
//                let main = hash.sub(3);
//                const url ='url'+'("'+'https://fuss10.elemecdn.com/'+one+'/'+two+'/'+main+'.'+type+'?imageMogr/format/webp/thumbnail/!40p/blur/50x40/'+'")';
//                console.log(url);
//                return url;
//            },




            getBackgroundImgUrl: function (hash) {

                let dir1 = hash.substring(0, 1);
                let dir2 = hash.substring(1, 3);
                let img = '';
                if(hash.substring(hash.length - 4) === 'jpeg'){
                    img = hash.substring(hash.length - 4);
                } else {
                    img = hash.substring(hash.length - 3);
                }
                let strContent = hash.substr(3);
                //覆盖背景url:background-image: url("https://fuss10.elemecdn.com/f/8d/f29dbf20be425fc12426c0b1f90b7jpeg.jpeg?imageMogr/format/webp/thumbnail/!40p/blur/50x40/");
                const url = "url('"+'https://fuss10.elemecdn.com/' + dir1 + '/' + dir2 + '/' + strContent + '.' + img + '?imageMogr/format/webp/thumbnail/!40p/blur/50x40/'+ "')";
                return url;
            }
        },
        async mounted  ()
        {



//            console.log('mounted');



//            console.log('created');
            this.$nextTick(function () {
//                console.log('nextTick created')
            });
            //获取由列表发过来的数据
            this.id = this.$route.query.id;
            this.latitude = this.$route.query.latitude;
            this.longitude = this.$route.query.longitude;
            await getShopmessage(this.id, this.latitude, this.longitude).then(response => {
                this.shopmessage = response;
//                console.log(this.shopmessage);
            }).catch(error => {
                console.log(error);
            });


            await getCommoditylist(this.id).then(response => {
//                console.log(this.id);
//                console.log('commod');
//                console.log(this.commoditylist);
                this.commoditylist = response;
//                console.log(this.commoditylist);

                    this.$nextTick(function () {
//                        console.log('next dlArrs');
                        let dlArr = this.$refs.dls;
//                        console.log(dlArr);
                        let dlHeightArr = [];
                        let sum = 0;
                        let i = 0;
                        for ( i; i < dlArr.length; i++)
                        {
                            sum = sum + dlArr[i].clientHeight;
                            dlHeightArr.push(sum);
                        }
                        this.dlHeightArrs = dlHeightArr;
                    });




//                document.getElementsByClassName('liList')[0].classList.add('activeted');

//                console.log(this.Commoditylist);
            }).catch(error => {
                console.log(error);
            });





        },
        created()
        {



        },


        beforeUpdate() {
//            console.log('bu');
        },

        updated() {

//            console.log('up');
        }




    }
</script>

<style lang="scss" type="text/scss">

    @import "../../scss/mixin.scss";

    .entirety
    {
        overflow-y: auto;
        height: 100%;
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s
        }

        .fade-enter, .fade-leave-to /* .fade-leave-active in below version 2.1.8 */
        {
            opacity: 0
        }
    }
    #shop
    {
        overflow-x: hidden;
        height: 100%;
    }
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

    .shop-tab-container {
        z-index: 200;
        position: sticky;
        top:pxToRem(-1px);
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
        display: flex;
        position: relative;
        line-height: pxToRem(29px);
        .commodity-main-left{
            flex-basis: auto;
            flex-grow: 0;
            flex-shrink: 0;
            height: pxToRem(1156px);
            background-color: rgb(248,248,248);
            display: block;
            font-size: pxToRem(24px);
            list-style-position: outside;
            list-style-type: none;
            overflow-y: scroll;
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
                display: block;
                border-bottom: 1px solid rgb(237,237,237);
                color: rgb(102,102,102);
                font-size: pxToRem(26px);
                line-height: pxToRem(31.2px);
                padding: pxToRem(35px) pxToRem(15px);
                position: relative;
                text-align: left;
            }
            .activeted
            {
                border-left: 5px solid blue;
                background-color: white;
            }


        }
        .commodity-main-right{
            -webkit-text-size-adjust: 100%;
            display: block;
            width: pxToRem(580px);
            height: pxToRem(1255px);
            flex-basis: 0;
            flex-grow:1;
            flex-shrink: 1;
            position: relative;
            .commodity-scroll
            {
                height: 100%;
                line-height: pxToRem(28.8px);
                overflow-y: scroll;
                dl
                {
                    dd
                    {
                        position: relative;
                        .list-food-content
                        {
                            .list-food-header-add
                            {
                                position: absolute;
                                right:0;
                                bottom: 0;
                                width: pxToRem(54px);
                                height: pxToRem(54px);
                                .add-yuan
                                {
                                    line-height: pxToRem(30px);
                                    font-size: pxToRem(40px);
                                    text-align: center;
                                    color: white;
                                    display: inline-block;
                                    position: absolute;
                                    bottom: 0;
                                    margin: 0 auto;
                                    width: pxToRem(40px);
                                    height: pxToRem(40px);
                                    border-radius: pxToRem(50px);
                                    background-color: rgb(49,144,232);
                                }
                                .add-yuan-select
                                {
                                    text-align: center;
                                    background-color: rgb(49,144,232);
                                    padding-top: pxToRem(10px);
                                    color: white;
                                    right: 0;
                                    border-radius: pxToRem(26px);
                                    position: absolute;
                                    bottom: 0;
                                    display: inline-block;
                                    width: pxToRem(102px);
                                    height: pxToRem(50px);
                                }
                            }
                            .list-food-header-price
                            {
                                color: rgb(255,102,0);
                                font-size: pxToRem(32px);
                                align-items: baseline;
                                display: flex;
                                font-weight: bold;
                                line-height: pxToRem(32px);
                                padding-bottom: pxToRem(7px);
                                position: absolute;
                                bottom: 0;
                            }
                            .list-food-content-right
                            {

                                .list-food-header-sales
                                {
                                    margin-top: pxToRem(13px);
                                    margin-bottom: pxToRem(13px);
                                    font-size: pxToRem(22px);
                                    line-height: pxToRem(22px);

                                }
                                .list-food-header-description
                                {
                                    color: rgb(153,153,153);
                                    font-size: pxToRem(19px);
                                    line-height: pxToRem(22.8px);
                                    margin-top: pxToRem(10px);
                                    margin-bottom: pxToRem(10px);
                                    overflow: hidden;
                                    white-space: nowrap;
                                }
                                header
                                {
                                    color: rgb(51,51,51);
                                    font-size: pxToRem(30px);
                                    line-height: pxToRem(33px);
                                    overflow-x: hidden;
                                    font-weight: bold;
                                }
                                padding-bottom: pxToRem(50px);
                                padding-left: pxToRem(182px);
                                width: 100%;
                                position: relative;
                            }
                            border-bottom: 1px solid rgba(46,46,46,0.2);
                            position: relative;
                            width: 100%;
                            padding: pxToRem(30px) pxToRem(20px);
                            @include flex();
                            img{
                                margin-right: pxToRem(-162px);
                                display: inline-block;
                                width: pxToRem(162px);
                                height: pxToRem(170px);
                                position: absolute;
                                top:pxToRem(30px);
                            }
                            .list-food-header
                            {
                                left: 0;
                                width: 100%;
                                @include flex();
                                position: absolute;
                                top:0;
                                span{
                                    color: white;
                                }
                            }
                        }
                    }
                    list-style: none;
                    dt
                    {
                        @include flex();
                        font-size: pxToRem(24px);
                        padding: pxToRem(15px) pxToRem(60px) pxToRem(15px) pxToRem(20px);
                        background-color: rgb(241,241,241);
                        .dt-left
                        {
                            display: flex;
                            overflow: hidden;
                            strong{
                                font-size: pxToRem(28px);
                                margin-right: pxToRem(10px);
                                overflow: auto;
                                white-space: nowrap;
                            }
                            /*span*/
                            /*{*/
                                /*color: rgb(153,153,153);*/
                                /*flex-grow: 1;*/
                                /*flex-shrink: 1;*/
                                /*font-size: pxToRem(20px);*/
                                /*white-space: nowrap;*/
                                /*overflow-x: hidden;*/
                                /*text-overflow: ellipsis;*/
                            /*}*/
                        }
                        .dt-right
                        {
                            position: relative;
                            span
                            {
                                color: rgb(51,51,51);
                                font-size: pxToRem(24px);
                            }
                            p
                            {
                                display: none;
                                border-radius: pxToRem(8px);
                                font-size: pxToRem(24px);
                                font-weight: normal;
                                opacity: 0.97;
                                position: absolute;
                                top:pxToRem(30px);
                                z-index: 200;
                                padding: pxToRem(18px) pxToRem(20px);
                                color: rgb(238,238,238);
                                background-color: #39373a;
                                width: pxToRem(364px);
                                right: pxToRem(10px);
                            }
                            .showPbox
                            {
                                display: block;
                            }
                        }

                    }
                }
            }
            & .select-enter-active, .select-leave-active {
                transition: all .5s ease;
            }

            & .select-enter, .select-leave-to
            {
                transform: translate3d(-50%,-50%,0) scale(0.5);
                opacity : 0;
            }


            /*& .select-leave-active {*/
                /*transition: all 5s;*/

            /*}*/


            & .select-leave {
                /*transform:  scale(1);*/
                opacity: 1;

                /*background-color: red;*/
            }

            /*& .select-leave-to*/
            /*{*/
                /*!*background-color: green;*!*/
                /*opacity: 0.5;*/
                /*!*transform: scale(0);*!*/
            /*}*/



        }

    }
    .guige
    {
        width: 600px;
        overflow: visible;
        border: 1px solid white;
        border-radius: pxToRem(8px);
        background-color: white;
        position: fixed;
        top:50%;
        z-index: 201;
        left: 50%;
        transform: translate(-50%,-50%);
        h1
        {
            line-height: pxToRem(45px);
            text-align: center;
            border-radius: pxToRem(8px);
            background-color: rgb(255,255,255);
            font-size: pxToRem(32px);
            padding: pxToRem(25px) pxToRem(60px);
        }
        .guiges
        {
            overflow: visible;
            overflow-y: auto;
            max-height: pxToRem(500px);
            padding-left: pxToRem(30px);
            padding-bottom: pxToRem(40px);
            font-size: pxToRem(24px);
            h2
            {
                font-size: pxToRem(26px);
                line-height: pxToRem(40px);
                color: rgb(102,102,102);
            }
            .guiges-content
            {
                a
                {
                    color: rgb(51,51,51);
                    display: inline-block;
                    border: 1px solid rgb(153,153,153);
                    border-radius: pxToRem(40px);
                    margin-right: pxToRem(30px);
                    margin-top: pxToRem(13px);
                    height: pxToRem(48px);
                    padding-left: pxToRem(18px);
                    padding-right: pxToRem(18px);
                    font-size: pxToRem(26px);
                    line-height: pxToRem(48px);
                    white-space: nowrap;
                }
            }

        }
        .guiges-price
        {
            @include flex();
            align-items: center;
            background-color: rgb(249,249,249);
            border:1px solid rgb(238,238,238);
            padding: pxToRem(25px) pxToRem(30px);
            font-size: pxToRem(24px);
            line-height: pxToRem(28.8px);
            p
            {
                font-size: pxToRem(42px);
                line-height: pxToRem(42px);
                color: rgb(255,96,0);
            }
            .xuanhaole
            {
                button
                {
                    background-color: rgb(49,153,232);
                    color: white;
                    border-radius: pxToRem(6px);
                    padding: 0 pxToRem(25px);
                    font-size: pxToRem(28px);
                    line-height: pxToRem(65px);
                }

            }
            .close
            {
                display: inline-block;
                position: absolute;
                right: pxToRem(30px);
                top:pxToRem(30px);
                font-size:pxToRem(60px) ;
                height: pxToRem(35px);
                color: rgb(51,51,51);
                opacity: 0.4;
            }
        }
    }
    .mengban
    {
        display: none;
        width: 100%;
        height: 100%;
        background-color: black;
        position: absolute;
        top:0;
        z-index: 200;
        opacity: 0.3;
    }
    .display
    {
        display: block;
    }




</style>