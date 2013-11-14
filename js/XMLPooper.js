function XMLPooper(game){
    var serializer = new XMLSerializer();
    return serializer.serializeToString (XmlizeGame(game));
}

function XmlizeGame(game){
    var xmlDoc = document.implementation.createDocument ("", "game", null);

    var title = xmlDoc.createElement ("title");

    xmlDoc.documentElement.appendChild (title);

    for(var i = 0; i < game.situations.length; ++i){
        xmlDoc.appendChild(XmlizeSituation(game.situations[i], xmlDoc));
    }

    return xmlDoc;

}



function XmlizeSituation(situ, doc){

    var situation = doc.createElement ("situation");
    situation.setAttribute ("code" , situ.code);

    var exposition = doc.createElement ("exposition");
    exposition.appendChild(doc.createTextNode(situ.text));

    situation.appendChild(exposition);

    if(situ.question)
        situation.appendChild(XmlizeQuestion(situation.question, doc));

    return situation;
}


function XmlizeQuestion(quest, doc){
    var question = doc.createElement ("question");
    question.setAttribute ("label" , quest.label);

    var answerpool = doc.createElement("answerpool");

    for(var i = 0; i < quest.answers.length; ++i)
        answerpool.appendChild(XmlizeAnswer(quest.answers[i], doc));

    question.appendChild(answerpool);

    return question;
}
function XmlizeAnswer(ans, doc){
    var answer = doc.createElement ("answer");
//    answer.setAttribute ("code" , ans.code);
    answer.setAttribute ("value" , ans.value);
    answer.setAttribute ("goto" , ans.goto);

    answer.appendChild(doc.createTextNode(ans.text));

    return answer;
}
