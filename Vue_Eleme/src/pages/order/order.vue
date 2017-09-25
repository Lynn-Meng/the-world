<template>
    <div id="order">
        <h1>订单</h1>
        <p>{{$route.query.id}}</p>
        <p>{{$route.query.name}}</p>
        <button @click="$router.push({
            path:'/mine',
            query:{
                girl:'韩梅梅',
                boy:'李雷',
            }
        })">Click me !</button>
        <m-footer></m-footer>

    </div>
</template>
<script type="text/ecmascript-6">

    import mFooter from '@/components/footer';
    export default
    {
        name:'order',
        beforeCreate()
        {
            console.log('beforeCreate')
        },
        created()
        {
            console.log('created');
        },
        beforeMount()
        {
            console.log('beforeMount');
        },
        Mounted()
        {
            console.log('Mounted');
        },
        beforeUpdate()
        {
            console.log('beforeUpdate');
        },
        updated()
        {
            console.log('updated');
        },
        beforeDestroy()
        {
            console.log('beforeDestroy');
        },
        destroyed()
        {
            console.log('destroyed');
        },
        beforeRouteEnter(to,from,next)
        {
            console.log('beforeEnter');
            console.log('to',to);
            console.log('from',from);
            console.log('this',this);
            next()
        },
        beforeRouteLeave(to,from,next)
        {
            console.log('beforeLeave');
            console.log('to',to);
            console.log('from',from);
            console.log('this',this);
            next();
        },
        beforeRouteUpdate(to,from,next)
        {
            console.log('beforeRouteUpdate');
            console.log('to',to);
            console.log('from',from);
            console.log('this',this);
            next();
        },
        components:{
            mFooter
        }
    }
</script>
<style>

</style>