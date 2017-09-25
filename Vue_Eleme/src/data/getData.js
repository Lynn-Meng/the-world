/**
 * Created by if-information on 2017/9/16.
 */
import fetch from '@/config/fetch';

export const getPosition = function () {
    if (navigator.geolocation)
    {
        return new Promise(function (success,reject) {
            navigator.geolocation.getCurrentPosition(success,reject,{timeout:1000,maximumAge:1e4})

        })
    }
    else
    {
        return Promise.reject('浏览器不支持地理定位');
    }
};

export const getAddress = function (latitude,longitude) {
    return fetch('/bgs/poi/reverse_geo_coding',{latitude,longitude});
};
export const getWeather = function (latitude,longitude) {
    return fetch('/bgs/weather/current',{latitude,longitude});
};
export const getHotword = function (latitude,longitude) {
    return fetch('/shopping/v3/hot_search_words',{latitude,longitude});
};
export const getClassify = function (latitude,longitude) {
    latitude = latitude + '&templates[]=main_template';
    return fetch('shopping/v2/entries',{latitude,longitude});
};
export const getShoplist = function (latitude,longitude,offset) {

    latitude = latitude + '&offset=' + offset +'&limit=20&extras[]=activities&terminal=h5';
    return fetch('/shopping/restaurants',{latitude,longitude});
};

export const getShopmessage = function (id,lati,long) {
    let url = '/shopping/restaurant/' + id + '?' + 'extras[]=activities&extras[]=albums&extras[]=license&extras[]=identification&extras[]=qualification&latitude=' + lati + '&longitude=' + long;
    return fetch(url,{lati,long});
};
export const getCommoditylist = function (id) {
    let url = '/shopping/v2/menu?restaurant_id=' + id;
    return fetch(url);
};



export const myMixin = {
    methods:{
        getImg:function(hash,size)
        {
            var one = hash.substring(0,1);
            var two = hash.substring(1,3);
            var type = hash.substring(32);
            var main = hash.substring(3);
            const url = 'https://fuss10.elemecdn.com/' + one + '/' + two + '/' + main + '.' + type + '?imageMogr/thumbnail/!' + size + 'r/gravity/Center/crop/' + size + '/';
            return url;
        },
    }
}


