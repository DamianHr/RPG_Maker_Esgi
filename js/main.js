function XMLWizard() {

    var situations = [];

    XMLWizard.prototype.create_xml_wizard = function(form_id) {
        XMLWizard.prototype.create_xml_wizard_group();
        XMLWizard.prototype.create_xml_wizard_add_button(form_id);
    }

    XMLWizard.prototype.create_xml_wizard_group = function() {
        var list_container;
        if($('.list_container').length == 0) {
            list_container = $('<ul></ul>',
                {   id:'list_container', class:'list_container' }
            ).insertBefore("#finalize-btn");
        } else list_container = $('ul.list_container');

        var list_element = $('<li></li>');
        list_container.append(list_element);

        list_element.append($("<label>",
            {   text:'Action #'+(situations.length+1)   }
        ));
        list_element.append($("<br />"));
        list_element.append($("<label />",
            {    text : 'Description :'}
        ));
        var description = $("<input/>",
            {   type:'text',
                placeholder:'Description of the scene',
                name:'keyword'  }
        );
        list_element.append(description);

        list_element.append($("<br />"));
        list_element.append($("<label />",
            {    text : 'Question :'}
        ));
        var question = $("<input/>",
            {   type:'text',
                placeholder:'Type',
                name:'type'  }
        );
        list_element.append(question);

        situations.push(new Situation(description, question));
    }

    XMLWizard.prototype.create_xml_wizard_add_button = function(form_id) {
        var form = $("#"+form_id);
        var div = $("<div/>",  {   class:'container' }  );
        var button  = $("<a/>",
            {   click: function () {
                    XMLWizard.prototype.create_xml_wizard_group(form_id);
                },
                value:'New Action',
                text:'New Action',
                class: 'btn btn-success'}
        );
        div.append(button);
        form.parent().append(div);
    }
}

function Situation(description, question) {
    this.description = description;
    this.question = question;
}