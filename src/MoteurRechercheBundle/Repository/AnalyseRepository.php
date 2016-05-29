<?php

namespace MoteurRechercheBundle\Repository;

/**
 * AnalyseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnalyseRepository extends \Doctrine\ORM\EntityRepository
{

	public function rechercheAnalyse($nomAnalyse){
		$queryBuider = $this->createQueryBuilder('a');
		$queryBuider ->where('a.nomAnalyse LIKE :nomAnalyse OR a.natureAnalyse LIKE :nomAnalyse')
			->orderBy('a.nomAnalyse', 'ASC')
			->setParameter('nomAnalyse','%'.$nomAnalyse.'%');

		return $queryBuider->getQuery()->getResult();	
	}
}
