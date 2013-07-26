
//Google Anayal API
	gadash.configKeys({
      'apiKey': API_KEY,
      'clientId': CLIENT_ID
    });

if($(window).width() < 995){
	var mwidth = $(window).width()-50;
	var mheight = mwidth/2.2;
}else if($(window).width() < 1200){
	var mwidth = $(window).width()-($(window).width()*.37);
	var mheight = mwidth/3.2;
}else if($(window).width() > 1200){
	var mwidth = 800;
	var mheight = 350;
}
 var lastthirty = new gadash.Chart({
      'type': 'LineChart',
      'divContainer': 'lastthirty',
      'last-n-days':30,
      'query': {
        'ids': TABLE_ID,
        'metrics': 'ga:visitors,ga:newVisits',
        'dimensions': 'ga:date'
      },
      'chartOptions': {
		width: mwidth,
        height: mheight,
        hAxis: {title:'Date'},
        vAxis: {title:'Visits'},
        curveType: 'function'
      }
    }).render();
	
	var browsers = new gadash.Chart({
      'type': 'PieChart',
	  'last-n-days':365,
      'divContainer': 'browsers',
      'query': {
        'ids': TABLE_ID,
		'metrics': 'ga:visitors',
        'dimensions': 'ga:browser'
      },
      'chartOptions': {
        height:300
      }
    }).render();
	
	
    var os = new gadash.Chart({
      'type': 'PieChart',
      'divContainer': 'os',
      'last-n-days':30,
      'query': {
        'ids': TABLE_ID,
        'metrics': 'ga:visitors',
        'dimensions': 'ga:operatingSystem'
      },
      'chartOptions': {
		height: 300
      }
    }).render();
	
	var sources = new gadash.Chart({
      'type': 'PieChart',
      'divContainer': 'sources',
      'last-n-days':365,
      'query': {
        'ids': TABLE_ID,
        'metrics': 'ga:visitors',
        'dimensions': 'ga:medium'
      },
      'chartOptions': {
        height: 300
      }
    }).render();
	