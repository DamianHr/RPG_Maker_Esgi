<div class="container">
    <h2>Create a Rpg game !</h2>
    <form method="post" autocomplete="on" id="xml_wizard">
        <input type="submit" name="submit" id="finalize-btn" value="Finalize" class="btn btn-primary" />
    </form>
</div>

<script type="text/javascript">
    var wizard = new XMLWizard();
    wizard.create_xml_wizard("xml_wizard");
</script>