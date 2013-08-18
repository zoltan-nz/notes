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
- Ubuntu topic: comparison Ubuntu, Lubuntu, Xubuntu
- Install ubuntu in virtualbox for rails development on windows 7
- Creating complicated form with default form helper with formtastic and with simple form. ERB and HAML templates.
- Rails debugging in RubyMine
- Live coding options (http://livestyle.emmet.io/)
- Client side and server side validation
- Install other operation system on a raw disk from ubuntu/mac via virtual computer
- Sorting with drag and drop, usign jquery ui and saving in the database, using data for url
- update_params() and update_all differencies, which more effective
- how to use curl
- How to manage registration and login with Devise and with modal windows. (http://pupeno.com/2010/08/29/show-a-devise-log-in-form-in-another-page/)
   http://natashatherobot.com/devise-rails-sign-in/

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

### Livereload settings

Don't mention sass and coffee!

Guardfile:

    guard 'livereload' do
      watch(%r{app/views/.+\.(erb|haml|slim)$})
      watch(%r{app/helpers/.+\.rb})
      watch(%r{public/.+\.(css|js|html)})
      watch(%r{config/locales/.+\.yml})
      # Rails Assets Pipeline
      watch(%r{(app|vendor)(/assets/\w+/(.+\.(css|js|html))).*}) { |m| "/assets/#{m[3]}" }
    end

### Speed up java app

Source: http://ubuntuforums.org/showthread.php?t=1129187

The trick:

    -Dsun.java2d.opengl=true

### RubyMine /opt/RM/bin/rubymine64.vmoptions

    -Xms256m
    -Xmx1024m
    -XX:MaxPermSize=512m
    -XX:ReservedCodeCacheSize=128m
    -XX:+UseCodeCacheFlushing
    -XX:+UseCompressedOops
    -ea
    -Dsun.io.useCanonCaches=false
    -Djava.net.preferIPv4Stack=true
    -Dsun.java2d.opengl=true


### Semantic form for option

    f.inputs for: '' do |f|

### How many gems do you use in your project

echo "We are using `cat Gemfile | grep "gem" | grep -v "#gem" | wc -l` gems in our project"

### Creating icons from your images

http://fontcustom.com/

    sudo apt-get install fontforge ttfautohint
    wget http://people.mozilla.com/~jkew/woff/woff-code-latest.zip
    unzip woff-code-latest.zip -d sfnt2woff && cd sfnt2woff && make && sudo mv sfnt2woff /usr/local/bin/
    gem install fontcustom

### Using Ruby on Rails for Wordpress database management

An option, using JSON api in wordpress and connect with this api to your Rails app. http://wordpress.org/plugins/json-api/


### jquery.validate plugin

http://jqueryvalidation.org/documentation/

### Action Cache topic

Deprecated in Rails 4, but how could you use it anyway?
