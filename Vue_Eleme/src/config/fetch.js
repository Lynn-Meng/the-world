

export default async (url='', data={},type='GET') => {


    type = type.toUpperCase();
    //路径后面拼接数据
    var dataStr = '';
    var getURL = url;

    Object.keys(data).forEach( key=>{
        dataStr += key + '=' + data[key] + '&';

    });




    if (dataStr !== '')
    {
        dataStr = dataStr.substr(0,dataStr.lastIndexOf('&'));
        getURL = url + '?' + dataStr;
    }



    if (window.fetch)
    {
        let requestConfig = {
            credentials:'include',
            method : type,
            headers:{
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            mode:'cors',
            cache:'force-cache'
        };
        switch (type)
        {
            case 'GET':
                url = getURL;
                break;
            case 'POST':
                Object.defineProperty(
                    requestConfig,'body',{
                        value:JSON.stringify(data)
                    }
                );
                break;
        }


        try {
            const response = await fetch(url,requestConfig);
            const responseJSON = response.json();
            return responseJSON;
        }
        catch (error)
        {
            console.log(error);
        }
    }
    else
    {
        console.log('不支持fetch');
        return new Promise((resolve,reject) => {
            let requestObj;
            requestObj = new XMLHttpRequest();
            let sendData = '';
            switch (type)
            {
                case 'GET':
                    url = getURL;
                    break;
                case 'POST':
                    sendData = JSON.stringify(data);
                    break;
            }
            requestObj.open(type,url,true);
            requestObj.setRequestHeader(
                'Content-type','application/json'
            );
            requestObj.setRequestHeader(
                'Accept','application/json'
            );
            requestObj.send(sendData);
            requestObj.onreadystatechange = () => {
                if (requestObj.readyState === 4 && requestObj.status === 200)
                {
                    let obj = requestObj.response;
                    if (typeof obj !== 'object')
                    {
                        obj = JSON.parse(obj);
                    }
                }
                else
                {
                    reject(requestObj);
                }
            }
        })
    }
}