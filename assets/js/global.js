let nfArray = []
let axiosArray = []
class Fetchmethod {
    constructor() {
    }
    get(url) {
        let promise = new Promise((resolve, reject) => {
            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();
            let t = new Date()
            axiosArray.push({
                timeStamp:t.getTime(),
                source:source,
                url: url,
                func: 'get'
            })
            cancelNotification()
            axios(url)
                .then(response =>{
                    let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                    axiosArray.splice(axiosArrayIndex, 1)
                    resolve(response)
                })
                .catch(response =>{
                    let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                    axiosArray.splice(axiosArrayIndex, 1)
                    reject(response)
                });
        })
        return promise;
    }
    post(url, data) {
        let promise = new Promise((resolve, reject) => {
            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();
            let t = new Date()
            axiosArray.push({
                timeStamp: t.getTime(),
                source: source,
                url: url,
                func: 'post'
            })
            if (url === 'includes/notifications.php') {
                if (nfArray.length === 0){
                    nfArray.push({
                        timeStamp: data.timestamp,
                        source: source,
                        url: url
                    })
                }else{
                    cancelNotification()
                }
            }else{
                cancelNotification()
            }
            axios.post(url, data, {
                cancelToken: source.token,    
            })
            .then(response => {
                let nfIndex = nfArray.map(e => e.timeStamp)
                nfArray.splice(nfIndex, 1)
                let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                axiosArray.splice(axiosArrayIndex, 1)
                return resolve(response)
            })
            .catch(response => {
                let nfIndex = nfArray.map(e => e.timeStamp).indexOf(t.getTime())
                nfArray.splice(nfIndex, 1) 
                let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                axiosArray.splice(axiosArrayIndex, 1)
                if (axios.isCancel(response)) {
                    console.log(response.message);
                } else {
                    reject(response)
                }
            });
        })        
        return promise;

    }
    getUrl(url) {
        let promise = new Promise((resolve, reject) => {
            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();
            let t = new Date()
            axiosArray.push({
                timeStamp: t.getTime(),
                source: source,
                url: url,
                func:'getUrl'
            })
            axios(url)
                .then(response => {
                    let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                    axiosArray.splice(axiosArrayIndex, 1)
                    resolve(response)
                })
                .catch(response => {
                    let axiosArrayIndex = axiosArray.map(e => e.timeStamp).indexOf(t.getTime())
                    axiosArray.splice(axiosArrayIndex, 1)
                    reject(response)
                });
        })
        return promise;
    }
}