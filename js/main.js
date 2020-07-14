(function(){
  // 'use strict';
 var vm = new Vue ({
    el: '#app',
    data: {
        list: [],
    },
    methods: {
      send_message: function(event, value) {
       var message = this.$refs.message
       if(!message.value.length){
         return
       }
       this.list.push({
         message: message.value,
         status:0
       })
       message.value=''
      },
    },

  })
})();