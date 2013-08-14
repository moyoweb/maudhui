<?php
defined('KOOWA') or die('Protected resource');
JFactory::getDocument()->setTitle('Share news item');
?>

<section id="news-share">
    <div class="main-container">
        <form action="" class="-koowa-form form-vertical" method="post" data-validate="true" data-ajax="false">

            <div class="control-group clearfix">
                <div class="controls">
                    <textarea name="message" placeholder="Share Message" style="width: 100%;"></textarea>
                </div>
            </div>

            <div class="control-group clearfix">
                <label class="control-label ui-input-text" for="title"><?= @text('Share news to this users') ?></label>
                <div class="controls ui-grid-b">
                    <div class="ui-block-a">
                        <?= @helper('com://site/profile.template.helper.listbox.select2', array(
                            'allow_clear' => true,
                            'name' => 'participants',
                            'remote' => true,
                            'attribs' => array(
                                'style' => 'width:300px',
                            ),
                        )) ?>
                    </div>
                    <div class="ui-block-b">
                        <buttn class="btn" id="add-attendee" type="button"><?= @text('Add') ?></button>
                    </div>
                    <div class="ui-block-c">
                    </div>
                </div>

                <div id="attendee-list" class="clearfix"></div>
            </div>

            <div class="control-group clearfix">
                <div class="controls">
                    <button class="btn pull-right" type="submit"><?= @text('Share News to Users'); ?></button>
                </div>
            </div>

            <input type="hidden" name="action" value="share" />
        </form>
    </div>
</section>
<script>
jQuery(document).ready(function($) {
    Invite = {
        count: 0,
        addAttendee: function() {
            var data = $('#select2-profile-participants').select2('data');
            if(data) {
                $('#select2-profile-participants').select2('val', '');
                $('#attendee-list').append(
                    $('<div id="attendee-'+Invite.count+'" class="float-left">'
                        +'<input type="hidden" name="participants[]" value="'+data.id+'" />'
                        +'</div>').append(
                            $('<a data-id="'+Invite.count+'" class="delete-btn">'+data.text+'</a>').click(Invite.delAttendee)
                        )
                );
                $('.delete-btn[data-id="'+Invite.count+'"]').buttonMarkup({ role:'button', inline:true, icon:'delete', iconpos:'right' });
                Invite.count++;
            }
        },
        delAttendee: function() {
            var id = jQuery(this).attr('data-id');
            jQuery('#attendee-'+id).remove();
        }
    };
    $('#add-attendee').click(Invite.addAttendee);
});
</script>