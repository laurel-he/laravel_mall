const SearchTool = {

    methods:{
        searchToolChange(name){
            this.$emit('search-tool-change', this[name]);
        },
        searchToolReset(name){
            this.$refs[name].resetFields();
            this.$refs[name].$emit('reset');
            this.$emit('search-tool-change', this[name]);
        }
    }
};


export default SearchTool;