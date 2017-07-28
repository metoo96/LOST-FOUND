var router = {
	action:function(controller){
		$('#mainPage')[0].src=controller;

		var lists = $('.nav-list');

		for(var i=0;i<lists.length;i++){
			if(lists[i].getAttribute('name') === controller){
				lists[i].setAttribute('class','active nav-list')
			}
			else if(lists[i].getAttribute('name')!=null){
				lists[i].setAttribute('class','nav-list')
			}
		}

	}
}