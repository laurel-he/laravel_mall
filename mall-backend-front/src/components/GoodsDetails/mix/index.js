const mix = {
    methods:{
        displayAttr(attr){
            return attr.map((item)=>{
                return item.name+":"+item.value
            }).join("、");
        },
        copy(source, target){
            source.forEach(function(item){
                this.push(Object.assign({}, item));
            }, target);
            return target;
        },
        loadGoodsAttr(data){
            if (data.specs) {
                data.specs.forEach(element => {
                    element.value = "";
                });
            }
            this._attrForm = data.specs;
            this._attrForm.forEach(function(item){
                item.fullurl = "";
                item.addon_value = "";
            })
            console.log(this._attrForm);
            this.attrForm = [];
            this.copy(this._attrForm, this.attrForm);
        },
    }
};

export default mix;