/**
 * Created by if-information on 2017/9/16.
 */
export const setStorage = function (key,value) {
    if (!key) return false ;
    if (typeof value !== 'stirng')
    {
        value = JSON.stringify(value);
    }
    window.localStorage.setItem(key,value);
};
export const getStorage = function (key) {
    const value = window.localStorage.getItem(key);
    return JSON.parse(value);
};