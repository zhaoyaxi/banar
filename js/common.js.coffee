@token = 'wanzysky'
@debug = true
###æäº¤è¡¨å•###
@submit_form = (form,url = form.attr('action'),success = submit_success,error = submit_error,debug) ->
    before = form.find('button[type=submit]').html()
    form.find('button[type=submit]').attr('disabled','disabled')
    form.find('button[type=submit]').html('åŠ è½½ä¸­...')
    $.ajax({
    url:url
    type:'POST'
    dataType:'json'
    async:true
    data:get_form_data(form)
    success:(data) ->
              console.log(data)
              init_pagination($(form.data 'pagination'),data.pagination) if form.data 'pagination'
              form.find('button[type=submit]').removeAttr('disabled')
              form.find('button[type=submit]').html(before)
              success(data)
    error: (a,b,c) ->
              console.log(a+b+c) if @debug
              form.find('button[type=submit]').removeAttr('disabled')
              form.find('button[type=submit]').html(before)
              error(a,b,c)
  })

###ajaxå‘é€postè¯·æ±‚###
@ajax_post = (url = '#', data = null, success = submit_success, error = null, debug = true) ->
  success_function = success
  data['token'] = @token
  $.ajax(
    {
      url:url
      data:data
      async:true
      type:'POST'
      dataType:'json'
      success: (data) -> success_function(data)
      error: (a,b,c) -> console.log a+b+c
    }
  )

###èŽ·å–è¡¨å•æ•°æ®###
@get_form_data = (form,name = 'data') ->
  inputs = form.find('input,textarea')
  result = {}

  if form.data 'pagination'
    do () ->
      result['page'] = $(form.data 'pagination').find('input[name=page]').val()
      result['size'] = $(form.data 'pagination').find('input[name=size]').val()

  for i in inputs
    name = i.name
    if i.value == ''
      continue

    if name.substring(name.length - 2) == '[]'
      name = name.substr(0,name.length - 2)
      if(result[name] instanceof Array)
        result[name].push(i.value)
      else
        result[name] = Array(i.value,)
    else
      result[i.name] = i.value

  selects = form.find('select')
  selects.each () ->
    if $(this).data('id')
      result[$(this).attr('name')+ '_name'] = $(this).val()
      result[$(this).attr('name') + '_id'] = $(this).data('id')
    else
      result[$(this).attr('name')] = $(this).val()
  result['token'] = @token
  result

###æäº¤æˆåŠŸ###
@submit_success = (data) ->
  unless data.status == 0
    $('#alert-info').html data.errmsg
    $('#error-alerter').show()
    setTimeout(() ->
      $('#error-alerter').hide(500)
    ,3000 )
  else
    window.location.href = '/' if data.status == 100
    $('#success-alerter').show()
    setTimeout(() ->
      $('#success-alerter').hide(500)
    ,3000 )

###æäº¤å¤±è´¥###
@submit_error = (a,b,c) ->
  try
    $('#alert-info').html 'ç½‘ç»œè¿žæŽ¥å¤±è´¥'
    $('#error-alerter').show()
    setTimeout(() ->
      $('#error-alerter').hide(500)
    ,3000 )
  catch e
    console.log('ä½ æ²¡æœ‰è®¾ç½®ä¿¡æ¯é”™è¯¯æç¤ºå¯¹è±¡')

###å•ä¸ªå¯¹è±¡htmlåŠ è½½###
@single_redirect = (object,url) ->
  object.load(url)

###åˆå§‹åŒ–form###
@init_form = (form,object) ->
  console.log object if @debug
  inputs = form.find('input, textarea, select')
  if(object instanceof Array)
    object = object[0]
  inputs.each(
    () ->
      nm = $(this).attr('name')
      if $(this).data('select') == 2
        $(this).select2('val',object[nm].split('|')) if object[nm]
      else if $(this).data('select') == 3
        $(this).select2('val',object[nm])
      else
        $(this).val(object[nm])

      true
  )
  try
    demo = form.find('.demo')
    container = demo.parent()
    container.children().not(demo).remove()
  catch error
    'no demo found'
  if object.sub
    subs = object.sub
    for i in subs
      current = demo.clone()
      current.find('input, textarea').each () ->
        nm = $(this).data('name')
        $(this).val(i[nm])
      current.removeClass('demo')
      container.append(current)
  true
  $('#files').children().remove()
  if(object['image_path'])
    $('#files').children().remove()
    img = $('<img width="200" height="200" />')
    img.attr('src',object['image_path'])
    a = $('<a class="th radius"></a>')
    a.attr 'href',object['image_path']
    a.append(img)
    $('#files').append(a)


@init_form_with_url = (form,url,id = null,callback) ->
  ajax_post(url,{id:id},
    (response) ->
      unless response.status == 0
        $('#alert-info').html response.errmsg
        $('#error-alerter').show()
      else
        init_form(form,response.data)
        console.log response if @debug
        callback(response) if callback
  )

@init_select = (select,data) ->
  select.find('option').not(':first').remove()
  for i in data
    select.append($('<option value="' + i.id + '">' + i.name + '</option>'))

###åˆå§‹åŒ–table###
@init_table = (table,data,map = null) ->
  table.find('tbody tr').not('.demo').remove()
  demo = table.find('.demo')
  num = 1
  for i in data
    current = demo.clone()
    current.removeClass 'demo'
    init_tr current,i,map,num++
    current.appendTo table.find('tbody')
  true

###åˆå§‹åŒ–Tr###
@init_tr = (row,data,map,num) ->
  td = row.find('td')
  data['num'] = num
  td.each(
    () ->
      name = $(this).data('name')
      if map != null
        data[name] = map[name][data[name]]
      $(this).html data[name] if name
  )
  true

###åˆå§‹åŒ–åˆ†é¡µ###
@init_pagination = (pagination,arr) ->

  location = pagination.find 'li:first'
  last = pagination.find('li:last')
  pagination.find('li').not(':first,:last').remove()
  sum = parseInt(arr.sum)
  page = parseInt(arr.page)
  size = parseInt(arr.size)

  location.unbind()
  last.unbind()

  if page == 0
    location.addClass 'unavailable'
  else
    location.removeClass 'unavailable'
    location.click () ->
      contain = $(this).parents('div:first')
      page_input = contain.find('input[name=page]')
      form_for = $(contain.data 'for')
      page_input.val page_input.val() - 1
      form_for.submit()

  if page == sum - 1
    last.addClass 'unavailable'
  else
    last.removeClass 'unavailable'
    last.click () ->
      contain = $(this).parents('div:first')
      page_input = contain.find('input[name=page]')
      form_for = $(contain.data 'for')
      page_input.val page_input.val() + 1
      form_for.submit()

  for i in [sum..1]
    do (i) ->
      current = $('<li><a href="javascript:void(0)"></a></li>')
      current.click () ->
        contain = $(this).parents('div:first')
        page_input = contain.find('input[name=page]')
        page_input.val parseInt($(this).children().data 'page') - 1
        form_for = $(contain.data 'for')
        form_for.submit()

      current.children().data 'page',i
      current.children().html i
      current.addClass 'current' if i == parseInt(page) + 1
      location.after current




