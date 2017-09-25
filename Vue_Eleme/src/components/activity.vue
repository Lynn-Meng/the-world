<template>
        <div id="activity">
            <!--<p>{{activity}}</p>-->
            <div class="shop-list-show" v-for="(huodong,index) in activity" v-if="index < 2">
                <span class="font-shou" v-bind:style="{backgroundColor: '#' + huodong.icon_color}">{{huodong.icon_name}}</span>
                <span class="font-news" >{{huodong.description}}</span>
            </div>
            <div class="shop-list-hidden" >
                <div v-for="(huodong,index) in activity" v-if="index >= 2">
                    <span class="font-shou" v-bind:style="{backgroundColor: '#' + huodong.icon_color}">{{huodong.icon_name}}</span>
                    <span class="font-news" >{{huodong.description}}</span>
                </div>
            </div>
            <div class="num-of-huodong" v-on:click="getClickTarget">
                {{getNumOfHuodong(activity)}}个活动
                <i class="fa fa-sort-desc"></i>
            </div>
        </div>
</template>
<script type="text/ecmascript-6">
    export default
    {
        name:'activity',
        props:['activity'],
        methods:{
            getNumOfHuodong:function ($array) {
                let j = 0;
                for (let i = 0 ; i < $array.length;i++)
                {
                    j++
                }
                return j;
            },
            getClickTarget:function (event) {
                event.target.previousElementSibling.classList.toggle('display');
                event.target.childNodes[1].classList.toggle('fa-sort-up');
            },
        }

    }
</script>
<style lang="scss" type="text/scss">
    @import "../scss/mixin.scss";

    .num-of-huodong
    {
        color: rgb(153,153,154);
        height: pxToRem(77px);
        line-height: pxToRem(20px);
        font-size: pxToRem(20px);
        padding-bottom: pxToRem(15px);
        position: absolute;
        right: 0;
        top:pxToRem(20px);
    }

    .shop-list-show
    {
        margin-top: pxToRem(5px);
    }
    .font-shou
    {
        font-size: pxToRem(22px);
        color: white;
        border: 1px solid rgb(112,188,70);
    }
    .font-news
    {
        font-size: pxToRem(22px);
    }
    .shop-list-hidden
    {
        display: none;
        margin-top: pxToRem(5px);
    }
    .display{
        display: block;
    }


</style>