<template>
    <div id="activ">
        <div class="shop-list-show" v-for="(huodong,index) in activity">
            <span class="font-shou" v-bind:style="{backgroundColor: '#' + huodong.icon_color}">{{huodong.icon_name}}</span>
            <span class="font-news" >{{huodong.description}}</span>
        </div>
    </div>
</template>
<script type="text/ecmascript-6">
    export default
    {
        name:'activity',
        props:['activity'],
        methods:{

        }
    }
</script>
<style lang="scss" type="text/scss">

    .shop-list-show
    {
        margin-top: pxToRem(5px);
    }
</style>