select n.nid as entity_id,
dsc.field_c_descripcion_value, dsc.field_c_descripcion_format,
fm.field_c_materia_tid,
fd.field_c_documentos_display, fd.field_c_documentos_description,
ff.formadores_id, ff.formadores,
fo.field_c_organiza_value,
fcd.field_c_centro_destinatario_value,
foa.field_c_orientado_a_value,
fc.field_c_curricular_value,
fn.field_c_nivel_value,
ftipo.field_c_tipo_value,
fsse.field_c_senalar_si_es_value,
fpl.field_c_plazas_value,
fas.field_c_asistentes_value,
fase.field_c_asistentes_est_value,
faspas.field_c_asistentes_pas_value,
faspdi.field_c_asistentes_pdi_value,
fnota.field_c_nota_format,
fni.field_c_nota_interna_value, fni.field_c_nota_interna_format,
fmod.field_c_modalidad_value,
fcu.field_c_centro_ubicacion_value,
fmv.field_c_min_virtuales_value,
fhor.field_c_horario_value,
s.*

from fb240205.node n
left join fb240205.field_data_field_c_descripcion dsc on n.nid=dsc.entity_id
left join (select entity_id, group_concat(field_c_materia_tid) as field_c_materia_tid from fb240205.field_data_field_c_materia group by entity_id) fm on n.nid=fm.entity_id
left join (select entity_id, group_concat(field_c_documentos_display) as field_c_documentos_display,
    group_concat(field_c_documentos_description) as field_c_documentos_description
    from fb240205.field_data_field_c_documentos group by entity_id) fd on n.nid=fd.entity_id
left join (select entity_id, group_concat(n.nid) as formadores_id, group_concat(title) as formadores from fb240205.field_data_field_c_formador f
    left join fb240205.node n on f.field_c_formador_target_id=n.nid group by entity_id) ff on n.nid=ff.entity_id    
left join (select entity_id, group_concat(field_c_organiza_value) as field_c_organiza_value
    from fb240205.field_data_field_c_organiza group by entity_id) fo on n.nid=fo.entity_id
left join (select entity_id, group_concat(field_c_centro_destinatario_value) as field_c_centro_destinatario_value
    from fb240205.field_data_field_c_centro_destinatario group by entity_id) fcd on n.nid=fcd.entity_id    
left join (select entity_id, group_concat(field_c_orientado_a_value) as field_c_orientado_a_value
    from fb240205.field_data_field_c_orientado_a group by entity_id) foa on n.nid=foa.entity_id
left join fb240205.field_data_field_c_curricular fc on n.nid=fc.entity_id
left join fb240205.field_data_field_c_nivel fn on n.nid=fn.entity_id
left join (select entity_id, group_concat(field_c_tipo_value) as field_c_tipo_value
    from fb240205.field_data_field_c_tipo group by entity_id) ftipo on n.nid=ftipo.entity_id
left join fb240205.field_data_field_c_senalar_si_es fsse on n.nid=fsse.entity_id
left join fb240205.field_data_field_c_plazas fpl on n.nid=fpl.entity_id
left join fb240205.field_data_field_c_asistentes fas on n.nid=fas.entity_id
left join fb240205.field_data_field_c_asistentes_est fase on n.nid=fase.entity_id
left join fb240205.field_data_field_c_asistentes_pas faspas on n.nid=faspas.entity_id
left join fb240205.field_data_field_c_asistentes_pdi faspdi on n.nid=faspdi.entity_id
left join fb240205.field_data_field_c_nota fnota on n.nid=fnota.entity_id
left join fb240205.field_data_field_c_nota_interna fni on n.nid=fni.entity_id
left join fb240205.field_data_field_c_modalidad fmod on n.nid=fmod.entity_id
left join fb240205.field_data_field_c_centro_ubicacion fcu on n.nid=fcu.entity_id
left join fb240205.field_data_field_c_min_virtuales fmv on n.nid=fmv.entity_id
left join fb240205.field_data_field_c_horario fhor on n.nid=fhor.entity_id
left join (select cs.entity_id as nid, d.field_s_duracion_value, fh.field_s_fecha_hora_value,
    fh.field_s_fecha_hora_value2, l.field_s_lugar_format, l.field_s_lugar_value 
    from fb240205.field_data_field_c_sesion cs
    left join fb240205.field_data_field_s_duracion d on cs.field_c_sesion_target_id=d.entity_id
    left join fb240205.field_data_field_s_fecha_hora fh on cs.field_c_sesion_target_id=fh.entity_id
    left join fb240205.field_data_field_s_lugar l on cs.field_c_sesion_target_id=l.entity_id
    where cs.entity_id=51451) s on n.nid=s.nid
    
where n.nid=51451;

select * from fb240205.node_type;
select * from fb240205.node where type='registro_de_curso';
select count(*) from fb240205.node where type='registro_de_curso';

select * from fb240205.node where type='registro_de_actividad';
select count(*) from fb240205.node where type='registro_de_actividad';</p>