<template>
    <div id="find">
        <h1>发现</h1>
        <button @click="$router.push({
            path:'/order',
            query:{
                id:23456,
                name:'Tom',
            }
        })">点击去order页面</button>
        <m-footer></m-footer>
    </div>
</template>
<script type="text/ecmascript-6">
    import child from '@/components/child';
    import mFooter from '@/components/footer';
    export default
    {
        name:'find',
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
        data()
        {
            return{

            }
        },

//            reversedMessage:function () {
//                return this.message.split('').reverse().join('.');
//            },
//            now:function () {
//                return Date.now();
//            }


        methods:{
                now:function () {
                    return Date.now();
                }
            },
        components:{
            mFooter,
            child
        }
    }
</script>
<style>

</style>