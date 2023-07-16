export function collectErrorsFromResponse<T>(response: object, errors: object) {
    let responseErrors = response?.error?.value?.data?.errors;
    let hasErrors = false;

    /** Static errors */
    for (let propName in errors) {
        errors[propName] = '';

        if (responseErrors && responseErrors[propName]) {
            errors[propName] = responseErrors[propName][0];
            hasErrors = true;
        }
    }

    /** Dynamic errors */
    for (let propName in responseErrors) {
        errors[propName] = responseErrors[propName][0];
    }

    return hasErrors;
}