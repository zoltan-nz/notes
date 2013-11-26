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
- Using Bootstrap 3 - Creating customized Bootstrap 3 team
- Design patterns
- A post about why faster .size than .length and .count in ActiveRecord
- Update more record in one query with Active Record in Rails
- Backbone with mustache, with handlebar, emblem... in slim or in haml... in rails and in other framework
- A website about one project with different frameworks... comparision...
- Will_paginate gem with remote true and with boostrap.
- Create nice list page with a loads of filter with jquery and with ajax on rails.
- Create filters and using cookie for storing filter settings.
- Create switcher button with btn-group and change boolean data on hidden field. Details below:

Filters: using ActiveModel, FormObject, etc... for a clean solution. 

- Install haml -> erb converter: HERBALIZER
- sudo apt-get install ghc6 ghc6-prof ghc6-doc cabal-install
- cabal update
- cabal install herbalizer
- sudo ln ~/.cabal/bin/herbalizer /usr/bin/herbalizer
- Development log view customization
- Caching. Deep level caching and russian doll caching.
- Using sortable and dropable jquery in proper way... maybe using of popover in rails
- Bootstrap popover dynamic content from ajax response.
- How you separate your logics between files in a huge rails app.
- Deeply nested includes and special eager loading, good example like this: 

      @departments = ProductCategory.where(depth: 0, "products.deleted_at" => nil).includes(:children, {children: :products}).order('products.sort_order').order('children_product_categories.sort_order').order(:sort_order)
- Concerns in Controllers and before/after_actions, example: Pusher
- Checking a value is float or not: if (!!Float('1.343244') rescue false)

### Getting the current object of a nested form

      f.object.(attributes)

## Refactoring controllers

[LINK](http://blog.codeclimate.com/blog/2012/10/17/7-ways-to-decompose-fat-activerecord-models/)

## Bundle console

A great command for gem development which load all libs:

      bundle console
      
More tip: http://rakeroutes.com/blog/lets-write-a-gem-part-two/

## Where to put stuff
http://stackoverflow.com/questions/1068558/oo-design-in-rails-where-to-put-stuff

## Objects on Rails
http://objectsonrails.com/

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

### Install latest NodeJs

    sudo apt-get update && sudo apt-get install python-software-properties python g++ make -y && sudo add-apt-repository ppa:chris-lea/node.js && sudo apt-get update && sudo apt-get install nodejs -y

### Creating RAMDISK for mysql database for boosting dev process

http://themattreid.com/wordpress/2011/04/04/mysql-and-ramdisk-or-how-to-make-tmpdir-usage-queries-faster/

http://www.linuxscrew.com/2010/03/24/fastest-way-to-create-ramdisk-in-ubuntulinux/

    mkdir /tmp/ramdisk; chmod 777 /tmp/ramdisk
    mount -t tmpfs -o size=256M tmpfs /tmp/ramdisk/

Update /etc/mysql/my.conf
    [mysqld]
    #
    # * Basic Settings
    #
    user    = mysql
    pid-file  = /var/run/mysqld/mysqld.pid
    socket    = /var/run/mysqld/mysqld.sock
    port    = 3306
    basedir   = /usr
    #datadir  = /var/lib/mysql
    datadir   = /tmp/ramdisk/mysql
    #tmpdir   = /tmp
    tmpdir    = /tmp/ramdisk

Create /tmp/ramdisk/mysql folder
    sudo chown mysql:mysql /tmp/ramdisk/mysql

Copy everything from /var/lib/mysql in /tmp/ramdisk/mysql


### Update more record in one query with Active Record in Rails

    #List of product ids in sorted order. Get from jqueryui sortable plugin.
    #product_ids = [3,1,2,4,7,6,5]
     
    #product_ids.each_with_index do |id, index|
    #  Product.where(id: id).update_all(sort_order: index+1)
    #end
     
    ##CASE syntax example:
    ##Product.where(id: product_ids).update_all("sort_order = CASE id WHEN 539 THEN 1 WHEN 540 THEN 2 WHEN 542 THEN 3 END")
     
    case_string = "sort_order = CASE id "      
        
    product_ids.each_with_index do |id, index|
      case_string += "WHEN #{id} THEN #{index+1} "
    end
        
    case_string += "END"
               
    Product.where(id: product_ids).update_all(case_string)

### Will_paginate with bootstrap

Source: http://railscasts.com/episodes/329-more-on-twitter-bootstrap?view=comments

config/initializers/will_paginate.rb

    if defined?(WillPaginate)
      module WillPaginate
        module ActionView
          def will_paginate(collection = nil, options = {})
            options[:renderer] ||= BootstrapLinkRenderer
            super.try :html_safe
          end

          class BootstrapLinkRenderer < LinkRenderer
            protected

            def html_container(html)
              tag :div, tag(:ul, html), container_attributes
            end

            def page_number(page)
              tag :li, link(page, page, :rel => rel_value(page)), :class => ('active' if page == current_page)
            end

            def previous_or_next_page(page, text, classname)
              tag :li, link(text, page || '#'), :class => [classname[0..3], classname, ('disabled' unless page)].join(' ')
            end

            def gap
              tag :li, link(super, '#'), :class => 'disabled'
            end
          end
        end
      end
    end

For remote: true option in javascript:

    $(document).ajaxComplete (event,request,options) ->
      $('#pagination-line a').attr('data-remote', 'true')

## Switcher

in the view: 

    .control-group
        = label_tag :button, 'Loyalty Card Status:', class: 'control-label'
        .controls
          .btn-group#customer_loyalty_card_enable_switcher{data: {toggle: 'buttons-radio'}}
            - default_classes = 'btn customer_loyalty_card_enabled switcher'
            =button_tag 'Enabled', value: 'true', class: (@customer_loyalty_card.enabled ? default_classes+' active' : default_classes)
            =button_tag 'Disabled', value: 'false', class: (@customer_loyalty_card.enabled ? default_classes : default_classes+' active')
            =f.hidden_field :enabled

javascript:

    $('.switcher:not(.bound)').addClass('bound').on('click', switcherManager)

    switcherManager = (e) ->
      e.preventDefault();
      $(@).parent().find('input').val($(@).val())
      

## How to write test?


- Don't test api with Capybara.
- Excelent list: [LINK](http://betterspecs.org/)


## Model and Object independent views


      def table_header
       table_header = (controller_name.classify.constantize.new.attributes.keys - ['created_at', 'updated_at']).map! {|key| key.titleize}
       table_header << 'Actions'
      end
      
      def table_lines(line)
       fields = []
       line.attributes.keys do |key|
         fields << line.try(key)
       end
       fields
      end

