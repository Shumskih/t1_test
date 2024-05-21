export default {
    getRandomSeconds: function(min, max) {
        return 1;
        // return (Math.floor(Math.random() * (max - min + 1)) + min) * 1000;
    },
    getUrl() {
        return `http://${document.location.host}`;
    }
}