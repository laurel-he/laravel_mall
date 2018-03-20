import Axios from 'axios';
import APP_CONST from '../config';

const instance = Axios.create({
    baseURL: APP_CONST.DOMAIN,
    timeout: 3000,
    withCredentials: true ,//process.env.NODE_ENV == 'development' ? false :true

});

export default instance;