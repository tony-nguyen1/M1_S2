Inductive IsFact : nat -> nat -> Prop :=
  | IsFact_0 : IsFact 0 1
  | IsFact_S : forall n m, IsFact n m -> IsFact (S n) (S n * m).

Fixpoint fact(n:nat) {struct n} : nat :=
  match n with
  | 0 => 1
  | S p => n * fact p
  end.

Require Import FunInd.

Functional Scheme fact_ind := Induction for fact Sort Prop.

Print fact_ind.

Lemma exo1_q4 : .
Proof.

Qed.
