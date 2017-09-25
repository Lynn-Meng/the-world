<template>
    <footer id="footer">
        <router-link to="/home" v-bind:class="{select:isHome}"><i class="fa fa-edge"></i><p>外卖</p></router-link>
        <router-link to="/find" v-bind:class="{select:isFind}"><i class="fa fa-safari"></i><p>发现</p></router-link>
        <router-link to="/order" v-bind:class="{select:isOrder}"><i class="fa fa-file-text-o"></i><p>订单</p></router-link>
        <router-link to="/mine" v-bind:class="{select:isMine}"><i class="fa fa-user-o"></i><p>我的</p></router-link>

    </footer>
</template>
<script  type="text/ecmascript-6 ">
    export default
    {
        name:'footer',
        data()
        {
            return{
                isHome:false,
                isFind:false,
                isOrder:false,
                isMine:false

            }
        },
        created()
        {
            switch (this.$route.path) {
                case '/home':this.isHome = true;
                break;
                case '/find':this.isFind = true;
                break;
                case '/order':this.isOrder = true;
                break;
                case '/mine': this.isMine = true;
                break;
                default:this.isHome = true;
            }
        }

    }
</script>
<style lang="scss" type="text/scss">
    @import "../scss/mixin.scss";
    #footer
    {
        position: fixed;
        background-color: rgb(255,255,255);
        width: 100%;
        height: pxToRem(100px);
        padding-top: pxToRem(10px);
        bottom:0;
        @include flex();
        z-index: 9999;
        color: rgb(102,102,102);
        & a
        {
            font-size: pxToRem(20px);
            display: inline-block;
            text-align: center;
            width: pxToRem(187.5px);
            flex:1;

            & i
            {
                cursor: auto;
                box-sizing: border-box;
                font-size: pxToRem(40px);
                height: pxToRem(40px);
                width: pxToRem(40px);
                transform-origin: pxToRem(20px) pxToRem(20px);
                line-height: pxToRem(29px);
            }
        }
    }
    .select
    {
        flex:1;
        color: deepskyblue;
    }

</style>