export default () => ({
    showProgress: false,
    barInit: false,
    barFull: false,
    manageBar() {
        if (this.$store.app.pageloading) {
            this.showProgress = true;
            setTimeout(() => {
                this.barInit = true;
            }, 5);
        } else {
            this.barFull = true;
            setTimeout(() => {
                this.showProgress = false;
                this.barFull = false;
                this.barInit = false;
            }, 200);
        }
    }
});