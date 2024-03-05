Fixpoint mult (n m : nat) {struct n} : nat :=
  match n with
  | 0 => 0
  | S p => plus (mult p m) m (*on match n, le 1er arg, on le remet en 1er*)
  end.

Eval compute in (mult 2 3).

Lemma exo1_q1 : forall n : nat, mult 2 n = plus n n.
Proof.
  intro.
  
  (* mult diminue sur n, donc quand on connait n, c'est juste du calcul *)
  simpl. (* pour calculer *)
  reflexivity.
Qed.

Lemma aux0 : forall n : nat, (plus n 2) = S (S n).
Proof.
  intro.
  induction n.
  - simpl. reflexivity.
  - simpl. rewrite IHn. reflexivity.
Qed.

Lemma aux0_bis : forall x y : nat, (plus x (S y)) = S (plus x y).
Proof.
  intro.
  intro.
  induction x.
  - simpl. reflexivity.
  - simpl. rewrite IHx. reflexivity.
Qed.

Lemma aux1_bis : forall x : nat, (plus x 0) = x.
Proof.
  intro.
  induction x.
  - simpl. reflexivity.
  - simpl. rewrite IHx. reflexivity.
Qed.

Lemma aux1 : forall n m : nat, (plus n (S m)) = S (plus n m).
Proof.
  intro.
  intro.
  induction n.
  - simpl. reflexivity.
  - simpl. rewrite IHn. reflexivity.
Qed.

Lemma exo1_q2 : forall n : nat, mult n 2 = plus n n.
Proof.
  intro.
  (* on connait pas le n, donc c'est plus dure *)
  induction n.
  - simpl. reflexivity.
  - simpl. rewrite IHn. rewrite aux0. rewrite aux1. reflexivity.
Qed.

Open Scope list.
(* Require Import List. *)

Parameter E : Type.

Fixpoint rev (n: list E): list E :=
(* Ça met le 1er élèm à la fin (hd), puis récursion *)
  match n with
  | nil => nil
  | hd::tl => (rev tl) ++ (hd::nil) (* concatenation de 2 listes*)
end.

Parameter a b c : E.
Eval compute in (rev (a::b::c::nil)).

Lemma exo2_q1 : forall (l : list E) (e : E), 
rev (l++(e::nil)) = e :: rev l.
Proof.
  induction l; intro.
  - simpl; reflexivity.
  - simpl. rewrite IHl. reflexivity.
Qed.

Lemma exo2_q2 : forall (l : list E), rev(rev(l)) = l.
Proof.
  induction l.
  simpl;reflexivity.
  simpl.
  rewrite (exo2_q1 (rev l)).
  rewrite IHl.
  reflexivity.
  (*
  intro l.
  induction l as [| hd tail IHl].
  - simpl. reflexivity.
  - simpl. rewrite exo2_q1. rewrite IHl. reflexivity.
  *)
Qed.

