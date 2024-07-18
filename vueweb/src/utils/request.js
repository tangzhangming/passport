import axios from 'axios';
import { useRoute, useRouter } from "vue-router";

const router = useRouter();
const route = useRoute();

const service = axios.create({
	baseURL: 'https://passport.520.com/web-api/',
	// 允许跨域请求携带cookie
  	withCredentials: true,
  	// 请求超时时间
  	timeout: 5000
});


service.interceptors.response.use(
	response => {
		const res = response.data

		// console.log(res)
		// if( res.code == 403 && route.name!='login' ){
		// 	return router.push({ name: 'login' });
		// }

		return response;
	},

	// 非200请求进入这里
	error => {
		var response = error.response;

	    return Promise.reject(error);
	}
)

export default service