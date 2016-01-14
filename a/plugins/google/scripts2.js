gapi.analytics.ready(function() {

  /**
   * Authorize the user immediately if the user has already granted access.
   * If no access has been created, render an authorize button inside the
   * element with the ID "embed-api-auth-container".
   */
  gapi.analytics.auth.authorize({
    container: 'authorize-button',
    clientid: CLIENT_ID,
  });

var visitors = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
        ids: 'ga:60994977',
      dimensions: 'ga:date',
      'start-date': '30daysAgo',
      'end-date': 'yesterday'
    },
    chart: {
      container: 'visitors',
      type: 'LINE',
      options: {
        width: '100%'
      }
    }
});
    
visitors.execute();
    
var sources = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
        ids: 'ga:60994977',
      dimensions: 'ga:source',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 10,
      sort: '-ga:sessions'
    },
    chart: {
      container: 'sources',
      type: 'PIE',
      options: {
        width: '100%',
        pieHole: 2/7
      }
    }
});

sources.execute();

var browsers = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
        ids: 'ga:60994977',
      dimensions: 'ga:browser',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 10,
      sort: '-ga:sessions'
    },
    chart: {
      container: 'browsers',
      type: 'PIE',
      options: {
        width: '100%',
        pieHole: 2/7
      }
    }
});

browsers.execute();

var metros = new gapi.analytics.googleCharts.DataChart({
    query: {
      metrics: 'ga:sessions',
      dimensions: 'ga:city',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
      'max-results': 50,
      sort: '-ga:sessions'
    },
    chart: {
      container: 'metros',
      type: 'GEO',
      options: {
        width: '100%'
      }
    }
});

metros.execute();

});