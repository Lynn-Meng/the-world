<template>
    <span class="block">
        <span class="black"><i class="fa fa-star" v-for="n in 5"></i></span>

        <span class="yellow" v-bind:style="{width:star / 5 * 100 + '%'}"  ><i class="fa fa-star" v-for="n in 5"></i></span>

    </span>

</template>
<script type="text/ecmascript-6">
    export default
    {
        name : 'star',
        props:['star'],
    }
</script>
<style type="text/scss" lang="scss" scope>
    @import "../scss/mixin.scss";

    .block
    {
        padding: 0;
        margin: 0;
        position: relative;
        display: block;

        .black
        {
            display: inline-block;
            width: 100%;
            color: rgb(102,102,102);
            opacity: 0.5;
        }
        .yellow{

            overflow: hidden;
            color: #FFCC33;
            position: absolute;
            top: 0;
            left:0;
            z-index: 100;
            white-space: nowrap;


        }

    }

</style>