<template>
    <div id="mine">
        <h1>我的</h1>

        <p>{{$route.query.girl}}</p>
        <p>{{$route.query.boy}}</p>

        <p>{{count}}</p>
        <p>{{localPositions}}</p>
        <br>
        <button @click="increment">X2</button>
        <br>
        <button @click="decrement">/2</button>

        <m-footer></m-footer>

    </div>
</template>
<script type="text/ecmascript-6">
    import {
        getPosition
    } from '@/data/getData';
    import mFooter from '@/components/footer';

    import {
        mapMutations
    } from 'vuex';
    export default
    {
        name:'mine',

        components:{
            mFooter,
        },

        computed:{
            count()
            {
                return this.$store.state.count;
            },
            localPositions()
            {
                return this.$store.state.positions;
            }
        },

        created()
        {
            console.log(this.$store.state.positions);
        },
        methods:{

            ...mapMutations({
                increment:'increment',
                decrement:'decrement'
            }),
//            increment: function () {
//                this.$store.commit('increment');
//            },
//
//            decrement(){
//
//                this.$store.commit('decrement');
//            },

        }

    }
</script>
<style>
    button{
        font-size: 100px;
    }
</style>