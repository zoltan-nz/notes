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
- Caching in Rails. Dali, mini-profiler...

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
   
##Virtualbox headless start

    VBoxManage startvm "VM name" --type headless
    
Shutting down:

Source: http://askubuntu.com/questions/82015/shutting-down-ubuntu-server-running-in-headless-virtualbox

Shutting down a guest using VBoxManage
A virtual machine can be controlled by command line using the VBoxManage command line tool:

    VBoxManage controlvm [nameofmachine] savestate       # saves the state of the VM like in suspend
    VBoxManage controlvm [nameofmachine] poweroff        # simply "unplugs" the VM
    VBoxManage controlvm [nameofmachine] acpipowerbutton # sends ACPI poweroff signal
    
For power off by ACPI the virtual OS needs to be capable to do so, and VirtualBox may also need to enable ACPI support for the VM.

Enable VirtualBox ACPI options:

    VBoxManage [nameofmachine] modifyvm --acpi on

Install ACPI support in the Ubuntu VM:

    sudo apt-get install acpid
Shutting down guest from SSH

A safer way to shut down the machine in case you have SSH access woud be to issue

    user@virtualmachine: sudo poweroff

This will take care to safely shut down and poweroff your guest OS.

###Usefull gems

bullet

http://www.codebeerstartups.com/2013/04/must-have-gems-for-development-machine-in-ruby-on-rails/

      gem "better_errors"
      gem "binding_of_caller"
      gem 'annotate'
      gem 'bullet'
      gem 'debugger'
      gem 'flay'
      gem 'hirb'
      gem 'localtunnel'
      gem 'lol_dba'
      gem 'mailcatcher'
      gem 'meta_request','0.2.1'
      gem 'pry'
      gem 'pry-doc'
      gem 'quiet_assets'
      gem 'rack-mini-profiler'
      gem 'railroady'
      gem 'rails-footnotes', '>= 3.7.5.rc4'
      gem 'rails_best_practices'
      gem 'reek'
      gem 'request-log-analyzer'
      gem 'smusher'
      gem 'zeus' # don't add this in your gemfile.

###Ruby environment changer alternatives

https://github.com/wayneeseguin/rvm/blob/master/help/alt.md

### Have to watch

http://railscasts.com/episodes/394-sti-and-polymorphic-associations?view=comments
