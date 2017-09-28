/**
 * Created by if-information on 2017/9/27.
 */

//本文件存储一些 突变具体函数
import {
    SAVE_LOCATION
} from './mutation-types';


export default
{
    [SAVE_LOCATION](state,location)
    {
        state.location = location;
    }
}