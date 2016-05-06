<?php

class Consulta extends BaseModel {
    
	public function credEntregadas($params){
		$sql="  select a.c_alias as odpe ,pd.c_num_ele dni,pd.c_mesa_rec as mesarec,pd.c_nombres as nombres,pd.c_ape_pat as appat,pd.c_ape_mat as apmat,
		us.c_usuario as usuario,to_char(pd.aud_cred_reg_fec,'".Constants::FORMAT_ORACLE."') as fecha,us.c_usuario as usuario
		from tab_padron_designacion pd
		inner join tab_mesa m on pd.c_mesa_rec=m.c_mesa_pk
		inner join tab_ubigeo u on m.c_ubigeo_pk=u.c_ubigeo_pk
		inner join tab_ambito a on u.n_ambito=a.n_ambito_pk
		left join tab_usuario us on pd.aud_cred_reg_user = us.n_usuario_pk";

		if($params->entregada=="true"){
			$sql=$sql.' where aud_cred_reg_fec is not null ';
			$sql=$sql." and to_char(pd.aud_cred_reg_fec,'DD/MM/YYYY') between '".$params->fechaIni."' and '".$params->fechaFin."' ";
			if($params->usuario!=="0"){
				$sql=$sql." and us.n_usuario_pk ='".$params->usuario."'";
			}
		}else{
			$sql=$sql.' where pd.aud_cred_reg_fec is null and pd.n_param_cargo_pk is not null and pd.n_param_estado not in ('.Constants::STATUS_TACHA.') ';
		}
		if($params->ambito!=='0'){
			$sql=$sql.' and a.n_ambito_pk ='.$params->ambito;
		}
		if($params->ubigeo!=="0"){
			$sql=$sql." and u.c_ubigeo_pk ='".$params->ubigeo."'";
		}
		$sql=$sql." order by odpe asc ,pd.c_mesa_rec asc,fecha desc ";
            //var_dump($sql);
		return DB::select(DB::raw($sql));
	}

	public function credByCargo($params){

		$sql=" select u.c_ubigeo_pk, a.c_alias,u.c_distrito,
			(select count(1) from tab_mesa m where m.c_ubigeo_pk=u.c_ubigeo_pk ) as mesas,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO.") as mm,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::PRESIDENTE ." and pd.aud_cred_reg_fec is not null) as epre,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::PRESIDENTE ." and pd.aud_cred_reg_fec is null) as nepre,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::SECRETARIO." and pd.aud_cred_reg_fec is not null) as esec,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::SECRETARIO." and pd.aud_cred_reg_fec is null) as nesec,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::TMIEMBRO." and pd.aud_cred_reg_fec is not null) as eter,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::TMIEMBRO." and pd.aud_cred_reg_fec is null) as neter,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::PSUPLENTE." and pd.aud_cred_reg_fec is not null) as epsu,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=". Constants::PSUPLENTE." and pd.aud_cred_reg_fec is null) as nepsu,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=".Constants::SSUPLENTE." and pd.aud_cred_reg_fec is not null) as essu,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=".Constants::SSUPLENTE." and pd.aud_cred_reg_fec is null) as nessu,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=".Constants::TSUPLENTE." and pd.aud_cred_reg_fec is not null) as etsu,
			(select count(1) from tab_padron_designacion pd,tab_mesa m  
			where m.c_mesa_pk = pd.c_mesa_rec and m.c_ubigeo_pk=u.c_ubigeo_pk and n_param_estado=".Constants::STATUS_SORTEADO." and n_param_cargo_pk=".Constants::TSUPLENTE." and pd.aud_cred_reg_fec is null) as netsu,
			0 as te,0 as tne
			from tab_ubigeo u
			inner join tab_ambito a on u.n_ambito=a.n_ambito_pk ";
		if($params->ambito!=='0'){
			$sql=$sql.' and a.n_ambito_pk ='.$params->ambito;
		}
            $sql=$sql.' group by a.c_alias,u.c_ubigeo_pk,u.c_distrito
                  order by a.c_alias,u.c_distrito ';
		return DB::select(DB::raw($sql));
	}
        
        public function credEntregadasByAmbito($ambito) {
               
                $sql = "select x.*, total_mesas.total_mesas
                        from (
                        select a.n_ambito_pk,
                        a.c_alias as first,
                        count(1) as tota_mm,
                        count(entreg.n_ambito) as entregadas,
                        (count(1)-count(entreg.n_ambito)) as no_entregadas,
                        to_char(round(((count(entreg.n_ambito)*100)/(count(1)-count(entreg.n_ambito))),3),'".Constants::FORMAT_PERCENTAGE_ORACLE."')as porc_entregadas
                        from tab_padron_designacion p 
                        inner join tab_ambito a
                        on p.n_ambito = a.n_ambito_pk
                        left join (select pd.c_num_ele,pd.n_ambito from tab_padron_designacion pd where pd.aud_cred_reg_fec is not null) entreg
                        on p.c_num_ele = entreg.c_num_ele";

                        

                        $sql=$sql." group by a.n_ambito_pk,a.c_alias) x
                        left join (select count(distinct pd.c_mesa_rec) as total_mesas,pd.n_ambito from tab_padron_designacion pd group by pd.n_ambito) total_mesas
                        on total_mesas.n_ambito = x.n_ambito_pk";

                        if($ambito!='0'){
                              $sql=$sql.' where x.n_ambito_pk ='.$ambito;
                        }
                        return DB::select(DB::raw($sql));        
    }
    
        public function credEntregadasByDistrito($ambito) {
                $sql = "select a.n_ambito_pk,
                        ub.c_distrito as first,
                        (select count(1) from tab_mesa m where m.c_ubigeo_pk=ub.c_ubigeo_pk) as total_mesas,
                        (select count(1) from tab_padron_designacion pp 
                        inner join tab_mesa mm 
                        on pp.c_mesa_rec = mm.c_mesa_rec
                        inner join tab_ubigeo uu
                        on mm.c_ubigeo_pk = uu.c_ubigeo_pk
                        where uu.c_ubigeo_pk= ub.c_ubigeo_pk) as tota_mm,
                        count(distinct j_entregados.c_num_ele) as entregadas,
                        ((select count(1) from tab_padron_designacion pp 
                        inner join tab_mesa mm 
                        on pp.c_mesa_rec = mm.c_mesa_rec
                        inner join tab_ubigeo uu
                        on mm.c_ubigeo_pk = uu.c_ubigeo_pk
                        where uu.c_ubigeo_pk= ub.c_ubigeo_pk)-count(distinct j_entregados.c_num_ele)) as no_entregadas,
                        to_char(round((count(distinct j_entregados.c_num_ele)*100)/
                        ((select count(1) from tab_padron_designacion pp 
                        inner join tab_mesa mm 
                        on pp.c_mesa_rec = mm.c_mesa_rec
                        inner join tab_ubigeo uu
                        on mm.c_ubigeo_pk = uu.c_ubigeo_pk
                        where uu.c_ubigeo_pk= ub.c_ubigeo_pk)),3),'".Constants::FORMAT_PERCENTAGE_ORACLE."')as porc_entregadas
                        from tab_padron_designacion pd
                        inner join tab_ambito a
                        on pd.n_ambito=a.n_ambito_pk 
                        inner join tab_ubigeo ub
                        on a.n_ambito_pk = ub.n_ambito
                        left join(select pc.c_num_ele,uc.c_ubigeo_pk from tab_padron_designacion pc 
                        inner join tab_mesa mc
                        on pc.c_mesa_rec = mc.c_mesa_rec
                        inner join tab_ubigeo uc
                        on mc.c_ubigeo_pk = uc.c_ubigeo_pk
                        where pc.aud_cred_reg_fec is not null) j_entregados
                        on ub.c_ubigeo_pk = j_entregados.c_ubigeo_pk";
				if($ambito!=='0'){
					$sql=$sql." where pd.n_ambito = '".$ambito."'";
				}
				$sql=$sql." group by a.n_ambito_pk,ub.c_distrito,ub.c_ubigeo_pk";
                return DB::select(DB::raw($sql));      
                        
        }
        
        public function credEntregadasByLocal($ambito,$ubigeo) {
            
            $sql = "select
                  u.c_ubigeo_pk,
                  '' as distrito,
                  count(distinct m.c_mesa_rec) as total_mesas,
                  l.c_nombre as local,
                  count(presidente.c_local_pk) as presidente,
                  count(secretario.c_local_pk) as secretario,
                  count(tercer_miem.c_local_pk) as tercer_miembro,
                  count(primer_sup.c_local_pk) as primer_sup,
                  count(segundo_sup.c_local_pk) as segundo_sup,
                  count(tercer_sup.c_local_pk) as tercer_sup,
                  (count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk)) as entregados,
                  (count(distinct m.c_mesa_rec)*6-(count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk))) as no_entregados,
                  round(((count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk))*100/(count(distinct m.c_mesa_rec)*6)),3) as porc_entregados,
                  'locales' as tipoFila
                  from tab_local l
                  inner join tab_mesa m
                  on l.c_local_pk = m.c_local
                  inner join tab_ubigeo u
                  on m.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='100' and pd.aud_cred_reg_fec is not null) presidente
                  on l.c_local_pk  = presidente.c_local_pk and m.c_mesa_rec = presidente.c_mesa_rec and presidente.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='101' and pd.aud_cred_reg_fec is not null) secretario
                  on l.c_local_pk  = secretario.c_local_pk and m.c_mesa_rec = secretario.c_mesa_rec and secretario.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='102' and pd.aud_cred_reg_fec is not null) tercer_miem
                  on l.c_local_pk  = tercer_miem.c_local_pk and m.c_mesa_rec = tercer_miem.c_mesa_rec and tercer_miem.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='103' and pd.aud_cred_reg_fec is not null) primer_sup
                  on l.c_local_pk  = primer_sup.c_local_pk and m.c_mesa_rec = primer_sup.c_mesa_rec and primer_sup.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='104' and pd.aud_cred_reg_fec is not null) segundo_sup
                  on l.c_local_pk  = segundo_sup.c_local_pk and m.c_mesa_rec = segundo_sup.c_mesa_rec and segundo_sup.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='105' and pd.aud_cred_reg_fec is not null) tercer_sup
                  on l.c_local_pk  = tercer_sup.c_local_pk and m.c_mesa_rec = tercer_sup.c_mesa_rec and tercer_sup.c_ubigeo_pk = u.c_ubigeo_pk";
                        if($ambito!=='0'){
                            $sql = $sql. " where u.n_ambito='".$ambito."' and u.c_ubigeo_pk ='".$ubigeo."' group by l.c_local_pk,l.c_nombre, u.c_ubigeo_pk order by u.c_ubigeo_pk";
                        }else{
                            $sql = $sql. " where u.c_ubigeo_pk ='".$ubigeo."' group by l.c_local_pk,l.c_nombre, u.c_ubigeo_pk order by u.c_ubigeo_pk";
                        } 
            return DB::select(DB::raw($sql));
        }
        
        public function credEntregadasByLocalDis($ambito) {
            
            $sql = "select
                  u.c_ubigeo_pk, 
                  u.c_distrito as distrito,
                  count(distinct m.c_mesa_rec) as total_mesas,
                  '' as local,
                  count(presidente.c_local_pk) as presidente,
                  count(secretario.c_local_pk) as secretario,
                  count(tercer_miem.c_local_pk) as tercer_miembro,
                  count(primer_sup.c_local_pk) as primer_sup,
                  count(segundo_sup.c_local_pk) as segundo_sup,
                  count(tercer_sup.c_local_pk) as tercer_sup,
                  (count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk)) as entregados,
                  (count(distinct m.c_mesa_rec)*6-(count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk))) as no_entregados,
                  round(((count(presidente.c_local_pk)+count(secretario.c_local_pk)+count(tercer_miem.c_local_pk)+count(primer_sup.c_local_pk)+count(segundo_sup.c_local_pk)+count(tercer_sup.c_local_pk))*100/(count(distinct m.c_mesa_rec)*6)),3) as porc_entregados,
                  'distritos' as tipoFila
                  from tab_local l
                  inner join tab_mesa m
                  on l.c_local_pk = m.c_local
                  inner join tab_ubigeo u
                  on m.c_ubigeo_pk = U.C_UBIGEO_PK
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='100' and pd.aud_cred_reg_fec is not null) presidente
                  on l.c_local_pk  = presidente.c_local_pk and m.c_mesa_rec = presidente.c_mesa_rec and presidente.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='101' and pd.aud_cred_reg_fec is not null) secretario
                  on l.c_local_pk  = secretario.c_local_pk and m.c_mesa_rec = secretario.c_mesa_rec and secretario.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='102' and pd.aud_cred_reg_fec is not null) tercer_miem
                  on l.c_local_pk  = tercer_miem.c_local_pk and m.c_mesa_rec = tercer_miem.c_mesa_rec and tercer_miem.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='103' and pd.aud_cred_reg_fec is not null) primer_sup
                  on l.c_local_pk  = primer_sup.c_local_pk and m.c_mesa_rec = primer_sup.c_mesa_rec and primer_sup.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='104' and pd.aud_cred_reg_fec is not null) segundo_sup
                  on l.c_local_pk  = segundo_sup.c_local_pk and m.c_mesa_rec = segundo_sup.c_mesa_rec and segundo_sup.c_ubigeo_pk = u.c_ubigeo_pk
                  left join
                  (select pd.c_num_ele,loc.c_local_pk,m.c_mesa_rec,ub.c_ubigeo_pk from tab_padron_designacion pd inner join tab_mesa m on pd.c_mesa_rec = m.c_mesa_rec inner join tab_ubigeo ub on ub.c_ubigeo_pk = m.c_ubigeo_pk inner join tab_local loc on m.c_local = loc.c_local_pk where pd.n_param_cargo_pk='105' and pd.aud_cred_reg_fec is not null) tercer_sup
                  on l.c_local_pk  = tercer_sup.c_local_pk and m.c_mesa_rec = tercer_sup.c_mesa_rec and tercer_sup.c_ubigeo_pk = u.c_ubigeo_pk";
                        if ($ambito!=='0') {
                            $sql = $sql." where u.n_ambito='".$ambito."' group by u.c_ubigeo_pk,u.c_distrito order by u.c_ubigeo_pk";
                        } else{
                            $sql = $sql." group by u.c_ubigeo_pk,u.c_distrito order by u.c_ubigeo_pk";
                        }
            return DB::select(DB::raw($sql));
        }
    
        

}
