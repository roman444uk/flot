export function getPhotoUrl<T>(photoUrl: string) {
    return useAppConfig().apiUrl + '/' + photoUrl;
}