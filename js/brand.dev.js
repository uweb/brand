var UW = UW || {}

UW.Brand = Backbone.View.extend({

    el : '#s',

    events : {
      'keyup' : 'search'
    },

    loading : 'loading',

    template : '<% _.each( results, function(result) { %> <a href="<%= result.url.replace("/cms", "") %>" title="<%- result.title %>"><%= result.title %></a> <% }) %>',

    initialize : function( options )
    {
        _.bindAll( this, 'search', 'render')
       this.results = options.results
       this.collection.on('sync', this.render )
    },

    search : _.debounce( function( e ) {

      if ( this.value === e.target.value ) return

      this.value = e.target.value

      this.results.addClass( this.loading )

      this.collection.search( this.value )

    }, 200 ),

    render : function()
    {
      this.results.removeClass( this.loading )
      this.results.html( _.template( this.template, { results : this.collection.toJSON() }))
    }

})

UW.Brand.Collection = Backbone.Collection.extend({

    url : UW.baseUrl,

    settings : {
      json : 'get_search_results',
      search : ''
    },

    search : function ( value ) {
      this.settings.search = value
      this.fetch( { data : this.settings })
    },

    parse : function( response ) {
      if ( response && response.posts )
        return response.posts;
    }

})

UW.Expanding_Container = Backbone.View.extend({

    events : {
        'click #see_more': 'animate'
    },

    initialize: function() {
        _.bindAll(this, 'animate', 'done');
        this.$inner = this.$el.find('.expanding-inner')
        this.$hidden = this.$inner.find('.hidden');
    },

    animate: function(event) {
        event.preventDefault();
        var height_before = this.$inner.height();
        this.$hidden.toggleClass('hidden');
        var height_after = this.$inner.height();
        if (this.$hidden.hasClass('hidden')){
            this.$hidden.removeClass('hidden');
            this.hide_after = true;
            height_after += 15;
        }
        else {
            this.hide_after = false;
            height_before += 15;
        }
        this.$inner.height(height_before);
        this.$inner.animate({'height': height_after + 'px'}, 500, this.done );
    },

    done: function  () {
        if (this.hide_after) {
            this.$hidden.addClass('hidden');
            this.$el.find('#see_more').text('See more');
        }
        else {
            this.$el.find('#see_more').text('See less');
        }
        this.$inner.removeAttr('style');
    }

})

$(document).ready( function() {
    UW.brand = new UW.Brand({ collection : new UW.Brand.Collection(), results: $('#brand-results') });
    UW.expanding_container = new UW.Expanding_Container({el:'.expanding' });
});
