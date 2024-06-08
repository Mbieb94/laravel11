const csrfToken = $('meta[name="csrf-token"]').attr('content');
const bearerToken = $('meta[name="bearer-token"]').attr('content');
const currentSegment = $('meta[name="current-segment"]').attr('content');
const baseUrl = $('meta[name="base-url"]').attr('content');
const urlDataTable = `${baseUrl}/api/v1/${currentSegment}`
const baseUrlApi = `${baseUrl}/api/v1`;