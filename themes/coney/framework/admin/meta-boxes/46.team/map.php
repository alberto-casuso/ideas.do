<?php

if(!function_exists('coney_qodef_map_team_single_meta')) {
    function coney_qodef_map_team_single_meta() {

        $meta_box = coney_qodef_create_meta_box(array(
            'scope' => 'team-member',
            'title' => esc_html__('Team Member Info', 'coney'),
            'name'  => 'team_meta'
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_position',
            'type'        => 'text',
            'label'       => esc_html__('Position', 'coney'),
            'description' => esc_html__('The members\'s role within the team', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_birth_date',
            'type'        => 'date',
            'label'       => esc_html__('Birth date', 'coney'),
            'description' => esc_html__('The members\'s birth date', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_email',
            'type'        => 'text',
            'label'       => esc_html__('Email', 'coney'),
            'description' => esc_html__('The members\'s email', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_phone',
            'type'        => 'text',
            'label'       => esc_html__('Phone', 'coney'),
            'description' => esc_html__('The members\'s phone', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_address',
            'type'        => 'text',
            'label'       => esc_html__('Address', 'coney'),
            'description' => esc_html__('The members\'s addres', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_education',
            'type'        => 'text',
            'label'       => esc_html__('Education', 'coney'),
            'description' => esc_html__('The members\'s education', 'coney'),
            'parent'      => $meta_box
        ));

        coney_qodef_create_meta_box_field(array(
            'name'        => 'qodef_team_member_resume',
            'type'        => 'file',
            'label'       => esc_html__('Resume', 'coney'),
            'description' => esc_html__('Upload members\'s resume', 'coney'),
            'parent'      => $meta_box
        ));

        for($x = 1; $x < 6; $x++) {

            $social_icon_group = coney_qodef_add_admin_group(array(
                'name'   => 'qodef_team_member_social_icon_group'.$x,
                'title'  => esc_html__('Social Link ', 'coney').$x,
                'parent' => $meta_box
            ));

                $social_row1 = coney_qodef_add_admin_row(array(
                    'name'   => 'qodef_team_member_social_icon_row1'.$x,
                    'parent' => $social_icon_group
                ));

                    ConeyQodefIconCollections::get_instance()->getSocialIconsMetaBoxOrOption(array(
                        'label' => esc_html__('Icon ', 'coney').$x,
                        'parent' => $social_row1,
                        'name' => 'qodef_team_member_social_icon_pack_'.$x,
                        'defaul_icon_pack' => '',
                        'type' => 'meta-box',
                        'field_type' => 'simple'
                    ));

                $social_row2 = coney_qodef_add_admin_row(array(
                    'name'   => 'qodef_team_member_social_icon_row2'.$x,
                    'parent' => $social_icon_group
                ));

                    coney_qodef_create_meta_box_field(array(
                        'type'            => 'textsimple',
                        'label'           => esc_html__('Link', 'coney'),
                        'name'            => 'qodef_team_member_social_icon_'.$x.'_link',
                        'hidden_property' => 'qodef_team_member_social_icon_pack_'.$x,
                        'hidden_value'    => '',
                        'parent'          => $social_row2
                    ));
	
			        coney_qodef_create_meta_box_field(array(
				        'type'          => 'selectsimple',
				        'label'         => esc_html__('Target', 'coney'),
				        'name'          => 'qodef_team_member_social_icon_'.$x.'_target',
				        'options'       => array(
					        '_self'     => esc_html__('Same Window', 'coney'),
					        '_blank'    => esc_html__('New Window', 'coney')
				        ),
				        'hidden_property' => 'qodef_team_member_social_icon_'.$x.'_link',
				        'hidden_value'    => '',
				        'parent'          => $social_row2
			        ));
        }
    }

    add_action('coney_qodef_meta_boxes_map', 'coney_qodef_map_team_single_meta', 46);
}