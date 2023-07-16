import type {UseFetchOptions} from 'nuxt/app'

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {

    let headers: any = {};
    const appConfig = useAppConfig();

    const token = useCookie('XSRF-TOKEN');
    if (token.value) {
        headers['X-XSRF-TOKEN'] = token.value as string;
    }
    headers['Accept'] = 'application/json';

    if (process.server) {
        headers = {
            ...headers,
            ...useRequestHeaders(['referer', 'cookie'])
        };
    }

    return useFetch(appConfig.apiUrl + path, {
        credentials: 'include',
        watch: false,
        ...options,
        headers: {
            ...headers,
            ...options?.headers
        },
    });
}