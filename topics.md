#Topics for blog

- cookie management with jquery and rails
- saving accordion status throughout pages
- include_blank: false
- Nested forms, build, attributes...
- Rails Presenters: Draper
- FormObjects
- More forms on the same page
- Using vagrant for projects... (Don't use 4.2.14 virtualbox...)
- Test results about why faster ruby in virtual machine than in native way...
- Use for determining remote ruby: $ which ruby

##Install haml -> erb converter: HERBALIZER

- sudo apt-get install ghc6 ghc6-prof ghc6-doc cabal-install
- cabal update
- cabal install herbalizer
- sudo ln ~/.cabal/bin/herbalizer /usr/bin/herbalizer

#Nested forms with checkboxes, many through associations

- build
- fields_for
- strong parameters
- controller update, saving
- validations

###Drag and drop, sorted list, jquery

Railscast http://railscasts.com/episodes/147-sortable-lists-revised

###Sortable with jQuery in tables

js.coffee:


    fixHelperModified = (e, ui) ->
      $originals = ui.children()
      $helper = ui.clone()
      $helper.children().each (index)->
        $(@).width($originals.eq(index).width())
      $helper.addClass('dragged-line')
  
    $('#available_modifiers, #active_modifiers').sortable(
      connectWith: '.connected_table'
      axis: 'y',
      items: 'tbody > tr',
      placeholder: 'sortable-placeholder',
      dropOnEmpty: true,
      handle: '.handle',
      helper: fixHelperModified,
      update: ->
        $.post($(@).data('update-url'), $(@).sortable('serialize'))
      start: (event, ui) ->
        console.log ui
        $('.sortable-placeholder').html($(ui.item).html())
      )
      .disableSelection()
      
sass:

    .handle
      cursor: move
    
    .sortable-placeholder
      background: #ffc40d
      opacity: 0.6
    
    .dragged-line
      background: #dddddd
      opacity: 0.2
      border: 2px solid

controller:

    def modifier_sort_order_active
      @product_category = ProductCategory.find(params[:product_category_id])
      modifier_category_ids = params[:modifier_category]
      @product_category.modifier_category_ids = modifier_category_ids
      modifier_category_ids.each_with_index do |id, index|
        @product_category.modifier_cat_product_cats.where(modifier_category_id: id).update_all(sort_order: index + 1)
      end

      render nothing: true
    end
    
routes:

    post :modifier_sort_order_active

views:

   table, data: update-url
   
